
{{-- <link rel="stylesheet" href="{{ asset('css/pdf.css') }}"> --}}
<style>
    {{ file_get_contents(public_path('css/pdf.css')) }}
</style>

<table width="100%" id="cabecalho">
    <thead>
        <tr>
            <th>
            </th>
        </tr>
        <tr>
            <th>
                <h4>
                    <img src="data:png;base64, <?= base64_encode(file_get_contents(public_path('img/brasao-republica.png'))) ?>" width="150px" alt="" srcset="">
                    <br>
                    Conselho Regional de Engenharia e Agronomia do Distrito Federal <br>
                    
                    @if(isset($unidadeMae) && !!$unidadeMae) {!! $unidadeMae !!} @endif
                
                    {{ $departamento }}
                </h4>
            </th>
        </tr>
    </thead>
</table>

