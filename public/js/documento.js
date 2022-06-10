function carregaTipoDocumento(baseUrl, idTipoDocumento) {
    $("#fk_id_unidade_origem").on('click', async function(){
        let id_unidade = $('#fk_id_unidade_origem').val();
    
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };
    
        fetch(`${baseUrl}/api/unidade/${id_unidade}/tiposDocumento`, requestOptions)
            .then(response => response.json())
            .then(result => {
                $("#fk_id_tipo_documento").empty();
                $("#fk_id_tipo_documento").append(`<option value=>Escolha o tipo de documento</option>`);
    
                result.forEach(tipo => {
                    $("#fk_id_tipo_documento").append(`<option value="${tipo.id_tipo_documento}" exige_destinatario="${tipo.exige_destinatario}" trava_assunto="${tipo.trava_assunto}" ${idTipoDocumento == tipo.id_tipo_documento ? 'selected' : ''}>${tipo.descricao}</option>`);
                });
            })
            .catch(error => console.log('error', error));
    })
}

function autosave(id_documento, baseUrl) {
    // A cada 10 segundos, pegue o conteudo de #tinymce e envie para o endpoint 'autosave/documento/{id_documento}' com o método PUT
    setInterval(function(){
        var headers = new Headers();
        headers.append("Content-Type", "application/json");

        var raw = JSON.stringify({
            "conteudo": tinymce.get('tinymce').getContent()
        });
          
        let requestOptions = {
            method: 'PUT',
            headers: headers,
            redirect: 'follow',
            body: raw
        };

        fetch(`${baseUrl}/api/autosave/documento/${id_documento}`, requestOptions)
            .then(response => response.text())
            .then(result => {
                console.log(result);
            })
            .catch(error => console.log('error', error));
    }, 10000);
}

async function travarAssunto(baseUrl){
    let tipo_documento_trava_assunto = $('#fk_id_tipo_documento').find(':selected').attr('trava_assunto');
    let processo = $('#fk_id_processo_vinculado').val();

    if(tipo_documento_trava_assunto == undefined){
        tipo_documento_trava_assunto = $('#fk_id_tipo_documento').attr('trava_assunto');
    }

    console.log(tipo_documento_trava_assunto, processo);

    if(tipo_documento_trava_assunto == '1' && !!processo){
        $('#assunto').attr('readonly', true);

        let dados_processo = await fetch(`/api/processo/${$('#fk_id_processo_vinculado').val()}`);

        dados_processo = await dados_processo.json();

        $('#assunto').val(dados_processo.assunto);

        // $('#assunto').attr('readonly', false);
    } else {
        $('#assunto').attr('readonly', false);
    }
}

async function carregaDadosRelato(){
    let estrutura_unidade = $("#fk_id_unidade_atual").find(':selected').attr('estrutura');
    let tipo_documento = $("#fk_id_tipo_documento").val();

    if(estrutura_unidade == '1' && tipo_documento == "36"){
        let dados_parecer = await fetch(`/api/documento/${$('#id_documento').val()}`);
    }

}

async function tratarDestinoDocumento() {
    let id_tipo_documento_select = $('#fk_id_tipo_documento').find(':selected').val()
    let id_unidade_atual_select = $("#fk_id_unidade_atual").find(':selected').val()

    let id_tipo_documento = $('#fk_id_tipo_documento').val()
    let id_unidade_atual = $("#fk_id_unidade_atual").find(':selected').val()
    
    id_unidade_atual = id_unidade_atual == undefined ? id_unidade_atual_select : id_unidade_atual;
    id_tipo_documento = id_tipo_documento == undefined ? id_tipo_documento_select : id_tipo_documento;

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };
    
    let url = `/api/destino-documento/${id_tipo_documento}/unidade/${id_unidade_atual}`
    
    console.log(url);
    let destinoDocumento = await fetch(url, requestOptions)
    
    $("#fk_id_usuario_atual").attr('disabled', false);
    
    console.log(destinoDocumento.status)
    if(destinoDocumento.status == 200){
        destinoDocumento = await destinoDocumento.json();
        
        $("#fk_id_usuario_atual").attr('disabled', true);
        console.log("AQUI")
    }
}
