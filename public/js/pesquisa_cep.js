function pesquisaCep (cep){
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };
      
    fetch(`https://viacep.com.br/ws/${cep}/json`, requestOptions)
        .then(response => response.json())
        .then(result => { 
            document.getElementById('logradouro').value = result.logradouro;
            document.getElementById('bairro').value = result.bairro;
            document.getElementById('cidade').value = result.localidade;
            document.getElementById('uf').value = result.uf;
        })
        .catch(error => console.log('error', error));
}