
function excluirAnexo(anexo){
    $(`input[name=arquivo_${anexo}]`).remove()
    $(`#linha-anexo-${anexo}`).remove()
}

function excluirDBAnexo(anexo, baseUrl = "http://localhost:7777"){
    let aceitaExcluir = confirm("Deseja realmente excluir o anexo? ")
    var myHeaders = new Headers();

    var requestOptions = {
        method: 'DELETE',
        headers: myHeaders,
        redirect: 'follow'
    };

    if(aceitaExcluir){

        fetch(baseUrl + "/api/anexo/" + anexo, requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));
        
        // $(`input[name=item_anexo_${anexo}]`).remove()
        $(`#db-linha-anexo-${anexo}`).remove()
    }
}


function iniciarAnexos(baseUrl = "http://localhost:7777", interno = true) {
    var contador_input = 0;

    //Coloca o primeiro input file no formulário 
    $('#anexo-inicial').append(`<input type="file" id="arquivo-${contador_input}" class="" />`)

    var inputfile = $(`#arquivo-${contador_input}`)
    inputfile.on('change', async () => {
        //valide o formato do arquivo, somente PDF, png, jpeg, jpg
        var ext = inputfile[0].files[0].name.split('.').pop().toLowerCase();
        if($.inArray(ext, ['pdf', 'png', 'jpeg', 'jpg']) == -1) {
            alert('Por favor, envie arquivos com as seguintes extensões: pdf, png, jpeg, jpg');
            inputfile.val('');
            return false;
        }

        //valide o tamanho do arquivo, somente 20MB
        if(inputfile[0].files[0].size > 20971520) {
            alert('Por favor, envie arquivos com no máximo 20MB');
            inputfile.val('');
            return false;
        }

        //Clona o Input e deixa ele escondido
        let cloneinput = inputfile.clone()
        //Cria um indice para o input, nunca terá dois inputs com o mesmo nome
        contador_input++
        cloneinput.attr('name', `arquivo_${contador_input}`)
        cloneinput.attr('id', `arquivo-${contador_input}`)
        $('#anexos').append(cloneinput)

        cloneinput.css('display', 'none');
        
        let nomeArquivo = cloneinput.val().replace(/C:\\fakepath\\/i, '');

        console.log(nomeArquivo, interno)
        if(interno){
            var myHeaders = new Headers();
    
            var requestOptions = {
                method: 'GET',
                headers: myHeaders,
                redirect: 'follow'
            };
    
            let tipoDocDigital = await fetch(baseUrl + "/api/docDigital", requestOptions)
            tipoDocDigital = await tipoDocDigital.json()
    
            let tipoDoc = await fetch(baseUrl + "/api/tipoAnexos", requestOptions)
            tipoDoc = await tipoDoc.json()
    
            let selectTipoDoc = tipoDoc.map(tipo => `<option value="${tipo.id_tipo_anexo }">${tipo.descricao}</option>`)
            let selectTipoDocDig = tipoDocDigital.map(tipo => `<option value="${tipo.id_tipo_doc_digital}">${tipo.doc_digitalizado}</option>`)
    
            
            $('#lista-anexo').append(`
                <tr id="linha-anexo-${contador_input}">
                    <td>
                        <small>${nomeArquivo}</small>
                    </td>
                    <td>
                        <select name="tipo_doc_${contador_input}" required="required" class="form-control form-control-sm">
                            <option value=>Selecione</option>
                            ${selectTipoDocDig}
                        </select>
                    </td>
                    <td>
                        <select name="desc_doc_${contador_input}" required="required" class="form-control form-control-sm">
                            <option value=>Selecione</option>
                            ${selectTipoDoc}
                        </select>
                    </td>
                    <td onclick="excluirAnexo(${contador_input})" class="text-danger"><i class="fas fa-trash"><i/></td>
                </tr>
            `);
        } else {
            
            $('#lista-anexo').append(`
                <tr id="linha-anexo-${contador_input}">
                    <td>
                        <small>${nomeArquivo}</small>
                    </td>
                    <td>
                        <input type="hidden" name="tipo_doc_${contador_input}" value="3">
                        
                    </td>
                    <td>
                        <input type="hidden" name="desc_doc_${contador_input}" value="221">

                        
                    </td>
                    <td onclick="excluirAnexo(${contador_input})" class="text-danger"><i class="fas fa-trash"><i/></td>
                </tr>
            `);
        }

    })

}


