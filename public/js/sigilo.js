function bindNumeroProtocolo(protocolo, id_protocolo) {
    $("#numero-protocolo").html(protocolo);
    $("#input-protocolo").html('')
    $("#input-protocolo").append(`<input type="hidden" class="form-control" id="protocolo" name="fk_id_protocolo" value="${id_protocolo}" readonly>`);
}

function bindIdDocumento(id_documento) {
    $("#fk_id_documento").val(null);
    $("#fk_id_documento").val(id_documento);
}