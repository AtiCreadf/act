
{{-- INTERNO --}}
@if(isset(Auth::user()->id) && Auth::user()->tipo_usuario == 1)
    <?php
        $permiteDefinirTipoAnexo = true;
    ?>
@else
{{-- EXTERNO --}}
    <?php
        $permiteDefinirTipoAnexo = false;
    ?>
@endif

<div class="row">
    <div class="col-12">
        <div class="form-group">
            
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    @if($permiteDefinirTipoAnexo)
                                        O documento digitalizado é:
                                    @endif    
                                </th>
                                <th>Tipo de documentos</th>
                            </tr>
                        </thead>
                        <tbody id="itensAnexo">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script> 
    $(document).ready(function(){
        $('#fk_id_assunto').on('click', async function () {
            var myHeaders = new Headers();
            var requestOptions = {
                method: 'GET',
                headers: myHeaders,
                redirect: 'follow'
            };

            // try {
                @if($permiteDefinirTipoAnexo)
                    let tipoDocDigital = await fetch("{{ env('APP_URL') }}" + "/api/docDigital", requestOptions)
                    tipoDocDigital = await tipoDocDigital.json()
                    let selectTipoDocDig = tipoDocDigital.map(tipo => `<option value="${tipo.id_tipo_doc_digital}">${tipo.doc_digitalizado}</option>`)
                @else
                    let selectTipoDocDig = '';
                @endif
    
                var urlItensAnexos = "{{ env('APP_URL') }}" + '/assunto/' + $(this).val() + '/itensAnexo';

                var itensAnexos = await fetch(urlItensAnexos, requestOptions);
                itensAnexos = await itensAnexos.json();
                console.log(itensAnexos);
                
            // } catch (error) {
            //     console.log('error', error);
                
            // }

            // await console.log(itensAnexos);

            let html = `
                        <tr>
                            <td colspan="1">
                                <input type="file" name="arquivo_0" id="arquivo">    
                            </td>
                            <td>
                                @if($permiteDefinirTipoAnexo)
                                    <select name="tipo_doc_0" class="form-control form-control-sm">
                                        <option value=>Selecione</option>
                                        ${selectTipoDocDig}
                                    </select>

                                @else
                                    <input type="hidden" name="tipo_doc_0" value="3">
                                @endif
                            </td>
                            <td>
                                <label class="form-check-label" for="arquivo">
                                    Anexo livre
                                </label>
                            </td>
                        </tr>
                        <input type="hidden" name="desc_doc_0" value="1">
                    `;

            itensAnexos.itensAnexo.forEach(item => {
                html += `<tr>
                            <td colspan="1">
                                <input type="file" name="arquivo_${item.id_tipo_anexo}" id="arquivo_${item.id_tipo_anexo}" ${item.obrigatorio == 1 ? "required='required'" : ""}>    
                            </td>
                            <td>
                                @if($permiteDefinirTipoAnexo)
                                    <select name="tipo_doc_${item.id_tipo_anexo}" required="required" class="form-control form-control-sm">
                                        <option value=>Selecione</option>
                                        ${selectTipoDocDig}
                                    </select>
                                @else
                                    <input type="hidden" name="tipo_doc_${item.id_tipo_anexo}" value="3">
                                @endif
                            </td>
                            <td>
                                <label class="form-check-label" for="arquivo_${ item.id_tipo_anexo }">
                                    ${item.obrigatorio == 1 ? "<b class='text-danger'>Obrigatório</b> - " : ""} ${ item.descricao } 
                                </label>
                            </td>
                        </tr>
                        <input type="hidden" name="desc_doc_${item.id_tipo_anexo}" value="${item.id_tipo_anexo}">
                        `;
            });

            $('#itensAnexo').html(html);

            if(itensAnexos.exigir_processo_pai == 1) {
                let inputProcessoPai = `
                    <div class="form-group">
                        <label for="fk_id_processo_pai">Escolha um processo pai *</label>
                        <select name="fk_id_processo_pai" id="fk_id_processo_pai" class="form-control" required>
                            <option value=>Escolha um processo pai</option>`;
                
                itensAnexos.possiveis_processos_pai.forEach(processo => {
                    inputProcessoPai += `<option value="${processo.id_processo}">${processo.descricao}</option>`;
                });

                inputProcessoPai += `</select>
                    </div>
                `;

                
                console.log(inputProcessoPai);
                $("#processo_pai").html(inputProcessoPai);
            }
        })
    });
</script>