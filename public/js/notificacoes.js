function notificacoes(id_usuario, baseUrl = "http://localhost:7777"){
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };
      
    fetch(`${baseUrl}/api/notificacoes?id_usuario=${id_usuario}`, requestOptions)
        .then(response => response.json())
        .then(notificacoes => {
            if(notificacoes.quantidade > 0){
                $("#contagem-notificacao").html(notificacoes.quantidade);
            } else {
                $("#contagem-notificacao").html("");
            }

            return notificacoes.notificacoes;
        })
        .then(notificacoes => { 
            var notificacoes_html = '';
            let dataAtual = new Date();
            for(var i = 0; i < notificacoes.length; i++){

                var data = new Date(notificacoes[i].created_at);
                var diferenca = dataAtual.getTime() - data.getTime();
                var dias = Math.floor(diferenca / (1000 * 60 * 60 * 24));
                var horas = Math.floor(diferenca / (1000 * 60 * 60));
                var minutos = Math.floor(diferenca / (1000 * 60));
                var segundos = Math.floor(diferenca / 1000);

                if(dias > 0){
                    notificacoes[i].data = dias + ' dias atrás';
                }else if(horas > 0){
                    notificacoes[i].data = horas + ' horas atrás';
                }else if(minutos > 0){
                    notificacoes[i].data = minutos + ' minutos atrás';
                }else if(segundos > 0){
                    notificacoes[i].data = segundos + ' segundos atrás';
                }

                notificacoes_html += `
                <a href="${baseUrl}/notificacao/${notificacoes[i].id_notificacao}/read" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title" >
                                <div style="word-break: break-word;">
                                    <small>
                                        ${notificacoes[i].texto}
                                    </small>
                                </div>
                                <span class="float-right text-sm text-primary"><i class="${notificacoes[i].visto == 1 ? "far" : "fas"} fa-star"></i></span>
                            </h3>
                            <!-- <p class="text-sm">Call me whenever you can...</p> -->
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>${notificacoes[i].data}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                `;
            }
            document.getElementById('notificacoes').innerHTML = notificacoes_html;
        })
        .catch(error => console.log('error', error));
}

