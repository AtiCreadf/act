<div class="form-group">
    <label>{{ $titulo ?? "Escolha palavras chave" }}</label>
    <select class="select2" multiple="multiple" data-placeholder="" style="width: 100%;" name="palavras_chave[]">
        @if(!!$palavras_chave)
            @foreach ($palavras_chave as $palavra)
                <option value="{{ $palavra }}" selected>{{ $palavra }}</option>
            @endforeach
        @endif
    </select>
</div> 