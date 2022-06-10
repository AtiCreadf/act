const carregarDestinatarios = (baseurl, select, usuario_definido = null) => {       
    // let usuarios = JSON.parse(localStorage.getItem('usuarios'));
    var usuarios = [];

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    
    fetch(`${baseurl}/api/usuarios?ids=all`, requestOptions)
        .then(response => response.json())
        .then(result => {
            usuarios = result;
            console.log(result);

            $(`${ select }`).empty();
            $(`${ select }`).append(`<option value=>Escolha o usuário</option>`);
            
            usuarios.forEach(usuario => {
                if(usuario_definido != null){
                    $(`${ select }`).append(`<option value="${usuario.id}" ${usuario.id == usuario_definido ? "selected" : ""} >${usuario.name}</option>`);
                } else {
                    $(`${ select }`).append(`<option value="${usuario.id}">${usuario.name}</option>`);
                }
            });
        })
        .catch(error => console.log('error', error));
}

const carregaUsuariosPorUnidade = (baseUrl, unidadeInput, userInput, usuario_definido = null) => {

    let unidade = unidadeInput.val()

    var usuarios = [];

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch(baseUrl + "/api/usuarios?id_unidade=" + unidade, requestOptions)
        .then(response => response.json())
        .then(usuarios => {
            userInput.empty();
            userInput.append(`<option value=>Escolha um usuário</option>`);

            console.log(usuarios);
            usuarios.forEach(usuario => {
                if(usuario_definido != null){
                    userInput.append(`<option value="${usuario.id}" ${usuario.id == usuario_definido ? "selected" : ""} >${usuario.name}</option>`);
                } else {
                    userInput.append(`<option value="${usuario.id}">${usuario.name}</option>`);
                }
            });
        })
        .then()
        .catch(error => console.log('error', error));
}

const carregarDestinatioTramite = (baseUrl, unidadeUltimoTramite, ehSigiloso, usuario_definido = null) => {

    let unidadeInput = $("#fk_id_unidade_destino");
    let userInput = $("#fk_id_usuario_destino");

    let unidade = unidadeInput.val()

    var usuarios = [];

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    if (unidade == unidadeUltimoTramite || ehSigiloso == 1) {
        fetch(baseUrl + "/api/usuarios?id_unidade=" + unidade, requestOptions)
            .then(response => response.json())
            .then(usuarios => {
                userInput.empty();
                userInput.append(`<option value=>Escolha um usuário</option>`);
    
                usuarios.forEach(usuario => {
                    if(usuario_definido != null){
                        userInput.append(`<option value="${usuario.id}" ${usuario.id == usuario_definido ? "selected" : ""} >${usuario.name}</option>`);
                    } else {
                        userInput.append(`<option value="${usuario.id}">${usuario.name}</option>`);
                    }
                });
            })
            .catch(error => console.log('error', error));

        $("#input_nova_situacao").addClass('col-md-12')
        $("#input_nova_situacao").removeClass('col-md-6')
        $("#div_usuario_destino").show()
    } else {
        userInput.empty();
        $("#div_usuario_destino").hide()
        $("#input_nova_situacao").removeClass('col-md-12')
        $("#input_nova_situacao").addClass('col-md-6')
    }

}