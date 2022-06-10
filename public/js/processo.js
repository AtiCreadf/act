const carregarDestinatariosPorUnidade = function(dom_select, id_unidade) {       
    var usuarios = [];

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    
    fetch(`/api/usuarios?id_unidade=${id_unidade}`, requestOptions)
        .then(response => response.json())
        .then(result => {
            usuarios = result;
            console.log(result);

            $(`${ dom_select }`).empty();
            $(`${ dom_select }`).append(`<option value=>Escolha o usuário</option>`);
            
            usuarios.forEach(usuario => {
                $(`${ dom_select }`).append(`<option value="${usuario.id}">${usuario.name}</option>`);
            });
        })
        .catch(error => console.log('error', error));
}