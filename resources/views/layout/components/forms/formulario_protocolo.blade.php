<div id="formulario-burro">
    
</div>

<script src="{{ asset('js/formularios.js') }}"></script>

<script>
    $('#fk_id_assunto').on('click', function() {
        // montarFormulario('#fk_id_assunto', "{{ env('APP_URL') }}")
        montarFormulario('#fk_id_assunto', "{{ env('APP_URL') }}")
    });
</script>
    {{-- $('#formulario-burro').load('{{ route('formulario_protocolo') }}'); --}} 