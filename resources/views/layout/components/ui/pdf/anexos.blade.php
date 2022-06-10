<h1 style="page-break-after: always:100%; text-align: center;">Anexos</h1>
@foreach ($anexos as $anexo)
    <img src="data:{{$anexo->extensaoArquivo()}};base64,{{ base64_encode(file_get_contents(env('STORAGE_PATH') . "/app/anexos/" . $anexo->caminho_anexo)) }}" alt="" width="100%">
@endforeach