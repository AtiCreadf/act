
<label for=""><b>ADICIONAR ANEXO:</b><br><small></small></label>
<div class="" id="anexo-inicial">


</div>
<div id="anexos">
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Anexos</th>
        <th scope="col">O documento digitalizado é: </th>
        <th scope="col">Especificação de anexo</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody id="lista-anexo">
        @foreach ($anexos as $anexo)
            <tr id="db-linha-anexo-{{ $anexo->id_anexo }}">
                <td><small>
                    <a href="{{ route('anexo.show', $anexo->id_anexo) }}">
                        {{ $anexo->caminho_anexo }}
                    </a>
                </small></td>
                <td><small>{{ $anexo->tipo_doc_dig }}</small></td>
                <td>
                    <small>
                        {{ $anexo->tipo_desc_doc ?? 'Não identificado' }}
                    </small>
                </td>
                <td>
                    @if (($pode_excluir))
                        <span id="item_anexo_{{ $anexo->id_anexo }}" class="text-danger" onclick="excluirDBAnexo({{ $anexo->id_anexo }}, '{{ env('APP_URL') }}')" ><i class="fas fa-trash"></i></span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table> 

<script src="{{ asset('js/anexos.js') }}"></script>
@if(isset(Auth::user()->id) && Auth::user()->tipo_usuario == 1)
    <script>
        iniciarAnexos('{{ env('APP_URL') }}');
    </script>
@else
    <script>
        iniciarAnexos('{{ env('APP_URL') }}', false);
    </script>
@endif
{{-- 
<script>
    $(function () {
        $("input:file").change(function () {//ou Id do input 
            var fileInput = $(this);
            var maxSize = $(this).data('max-size');
            console.log(fileInput.get(0).files[0].size);

            //aqui a sua função normal
            if (fileInput.get(0).files.length) {
                var fileSize = fileInput.get(0).files[0].size; // in bytes
                if (fileSize > maxSize) {
                    alert('file size is more then' + maxSize + ' bytes');
                    return false;
                } else {
                    alert('file size is correct- ' + fileSize + ' bytes');
                }
            } else {
                alert('choose file, please');
                return false;
            }
        });
    });
</script> --}}