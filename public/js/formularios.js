var contador_input = 0;
var contador_regra = 0;
var contador_opcao = 0;

function removerElemento(id_elemento) {
    $(id_elemento).remove();
}

function removerInput(id_input, baseUrl) {
    var requestOptions = {
        method: 'DELETE',
        redirect: 'follow'
      };
      
      fetch(`${baseUrl}/api/input/`, requestOptions)
        .then(response => response.json())
        .then(result => {
            if(result.sucesso) {
                $(`#input_group_db_${id_input}`).remove();
            } else {
                alert("Erro ao remover o input");
            }
        })
        .catch(error => console.log('error', error));

    $(id_input).remove();

}

async function novoInput(baseUrl) {

    let tiposInput = await fetch(baseUrl + "/api/tiposInput");

    let tiposInputJson = await tiposInput.json();

    let htmlTiposInput = tiposInputJson.map(tipo => `<option value="${tipo.id_tipo_input}" tipo="${tipo.tipo}" tem_opcao="${tipo.tem_opcao}">${tipo.descricao}</option>`);

    contador_input++;
    $("#lista-inputs").append(
        `
        <div class='card mt-2' id="input-group-${contador_input}">
            <div class='card-body'>
                <div >
                    <div class="row" id="input-group-${contador_input}">
                        <div class="col-12 col-md-3">
                            <label for="input_nome_${contador_input}">Pergunta</label>
                            <input required type="text" class="form-control" id="input_nome_${contador_input}" name="input_nome_${contador_input}" placeholder="Pergunta">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="input_tipo_${contador_input}">Tipo do campo</label>
                            <select required class="form-control" id="input_tipo_${contador_input}" name="input_tipo_${contador_input}" onchange="novaOpcao('#input_tipo_${contador_input}')">
                                ${htmlTiposInput}
                            </select>
                        </div>
                        <div class="col-12 col-md-3" id="nova-opcao-${contador_input}">
                        </div> 
                    </div>
                    
                    <div class="row" id="opcoes-${contador_input}">
                    </div> 
                    <div class="row" id="regras-${contador_input}">
                    </div> 
                </div>
            </div>
            <div class="card-footer">
                <div class="row d-flex align-items-center">
                    <span class="border-right border-secondary pr-3 mr-3">
                        <button type="button" class="btn btn-danger" onclick="removerElemento('#input-group-${contador_input}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </span>
                    <span>
                        <label for="input_obrigatorio_${contador_input}">&nbsp;</label>
                        <input type="checkbox" id="input_obrigatorio_${contador_input}" name="input_obrigatorio_${contador_input}" placeholder="Obrigatório">
                        <label for="input_obrigatorio_${contador_input}">Obrigatório</label>
                    </span>
                </div>
            </div>
        </div>
        ` 
    );

    $(`#input_nome_${contador_input}`).focus();

}

async function novaRegra(id_lista_regras, baseUrl) {
    let regras = await fetch(`${baseUrl}/api/regras`);

    let regrasJson = await regras.json();

    let htmlRegras = regrasJson.map(regra => `<option value="${regra.id_regra}">${regra.label_regra}</option>`);

    contador_regra++;
    $(`#${id_lista_regras}`).append(
        `<div class="row" id="regra-group-${contador_regra}">
            <div class="col-4 ml-1">
                <label for="regra-${contador_regra}">Regra</label>
                <select class="form-control" id="regra-${contador_regra}">
                    ${htmlRegras}
                </select>
            </div>
            <div class="col-4 ml-1">
                <label for="valor-${contador_regra}">Valor</label>
                <input type="${tipoInput}" class="form-control" id="valor-${contador_regra}" placeholder="Valor">
            </div>
            <div class="col-2 ml-1">
                <label for="${contador_regra}">&nbsp;</label>
                <button type="button" class="btn btn-danger form-control" onclick="removerElemento('#regra-group-${contador_regra}')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`
    );

    $(`#regra-${contador_regra}`).focus();
}

async function montarFormulario(id_assunto, baseUrl) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    let assunto = $(id_assunto).val()
    // let assunto = 295;
    
    if(!!assunto) {
        fetch(`${baseUrl}/api/formulario/${assunto}`, requestOptions)
            .then(response => response.json())
            .then(result => montarFormulario(result))
            .catch(error => console.log('error', error));
    }

}

async function montarFormularioById(id_formulario, baseUrl){
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    $("#formulario-burro").empty();

    if(!!id_formulario){
        fetch(`${baseUrl}/api/formularioById/${id_formulario}`, requestOptions)
            .then(response => response.json())
            .then(result => montarFormulario(result))
            .catch(error => console.log('error', error));
    }

}

function montarFormulario(result){
    $("#formulario-burro").empty();
    if(!result.error) {
        
        const newLocal = '';
        let htmlFormulario = newLocal;

        
        result.forEach(formulario => {
            htmlFormulario += `<div class="card"><div class="card-body">`;
            
            htmlFormulario += `<strong >Orientações de preenchimento</strong> <br>`;
            htmlFormulario += `<strong >Formulário: ${formulario.descricao}</strong><br>`;

            htmlFormulario += formulario.orientacao_preenchimento
            htmlFormulario += formulario
                .inputs
                .map((input) => {
                
                    let label = `<label for="">${input.label}</label>`
                    if(input.tipo_input == "checkbox") {
                        return  `<input type="${input.tipo_input}" name="form_d_form_${input.fk_id_formulario}_${input.nome_banco}" placeholder="${input.label}" ${input.regra}> ` + label
                    } else if(input.tipo_input == "select"){

                        let htmlOpcoes = input.opcoes.map(opcao => `<option value="${opcao.opcao}">${opcao.opcao}</option>`);

                        return `
                            ${label}
                            <select name="form_d_form_${input.fk_id_formulario}_${input.nome_banco}" class="form-control" >
                                ${htmlOpcoes}
                            </select>
                        `
                            
                    } else {
                        return label + `<input type="${input.tipo_input}" class="form-control" name="form_d_form_${input.fk_id_formulario}_${input.nome_banco}" placeholder="${input.label}" ${input.regra}>`
                    }
                })
                .join('')

                htmlFormulario += `</div></div>`;
        })

        // Envolva htmlFormulario com um .card
        $("#formulario-burro").append(htmlFormulario);
    }
}

async function novaOpcao(elemento) {
    let tipo_input = $(`${elemento} :selected`);
    let tem_opcao = tipo_input.attr('tem_opcao');

    let id_input = elemento.replace('#input_tipo_', '');
    $(`#nova-opcao-${id_input}`).empty()

    if(tem_opcao == "1") {

        // $(`#nova-opcao-${id_input}`).html(`
        //     <div>
        //         <label>&nbsp;</label>
        //         <a class="form-control btn btn-success">
        //             <i class="fas fa-plus"></i>
        //             Nova opção
        //         </a>
        //     </div>
        // `)

        $(`#opcoes-${id_input}`).empty();
        $(`#opcoes-${id_input}`).append(`
            <div class="col-12">
                <label for="opcao-${id_input}">As TAGs serão as opções da pergunta</label> <br>
                <select id="opcao-${id_input}" name="opcao-${id_input}[]" class="select2" multiple="multiple" data-placeholder="" style="width: 60%;">
                </select>
            </div>
        `);
        $('.select2').select2({
            //-^^^^^^^^--- update here
            tags: true,
            placeholder: "Select an Option",
            allowClear: true,
            width: '50%'
        });
    } else {
        $(`#opcoes-${id_input}`).empty();
    }
}