<div style="page-break-after: always"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <th>
            GRAU DE SIGILO: {{ strtoupper($protocolo->grau_sigilo) }}
        </th>
    </tr>
</table>
<table  width="100%" cellspacing="0" cellpadding="5"  align="left">
    <thead>
        <tr>
            <th>TERMO DE CLASSIFICAÇÃO DE INFORMAÇÃO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ÓRGÃO/ENTIDADE: CREA-DF</td>
        </tr>
        <tr>
            <td>CÓDIGO DE INDEXAÇÃO: {{ mask($protocolo->numero_protocolo, '##.###.######/####') }}</td>
        </tr>
        <tr>
            <td>CATEGORIA: {{ ($protocolo->categoria_sigilo) }}</td>
        </tr>
        <tr>
            <td>TIPO DE DOCUMENTO: {{ ($tipoDocumento) }}</td>
        </tr>
        </tr>
        <tr>
            <td>DATA DE PRODUÇÃO: {{ alterarDataMysqlBr($protocolo->created_at) }}</td>
        </tr>
        </tr>
        <tr>
            <td>FUNDAMENTO LEGAL PARA CLASSIFICAÇÃO: {{ $protocolo->identificador_categoria_sigilo }} - {{ $protocolo->normativo_sigilo }}</td>
        </tr>
        </tr>
        <tr>
            <td>RAZÕES PARA A CLASSIFICAÇÃO: {{ $protocolo->razao_classifica_sigilo }}</td>
        </tr>
        </tr>
        <tr>
            <td>PRAZO DA RESTRIÇÃO DE ACESSO: {{ alterarDataMysqlBr($protocolo->prazo_sigilo) }}</td>
        </tr>
        </tr>
        <tr>
            <td>DATA DE CLASSIFICAÇÃO: {{ alterarDataMysqlBr($historicoSigilo[0]->created_at) }}</td>
        </tr>
 
        @foreach($historicoSigilo as $historico)
            <tr>
                <td align="center">
                    <table>
                        <tr>
                            <td>
                                <img src="data:image/png;base64, <?= base64_encode(file_get_contents(public_path('img/assinatura_90.png'))) ?>" >
                            </td>
                            <td>
                                {{$historico->tipo_altera_sigilo}} assinada(o) eletronicamente por {{ $historico->nome_usuario }}, {{ ($historico->cargo_usuario) }}, 
                                em {{ date("d/m/Y", strtotime($historico->created_at)) }}, às {{ date("H:i", strtotime($historico->created_at)) }}, 
                                conforme horário oficial de Brasília, com fundamento no art. 4º, § 3º, do 
                                <a href="http://www.planalto.gov.br/ccivil_03/_Ato2019-2022/2020/Decreto/D10543.htm">Decreto nº 10.543, de 13 de novembro de 2020
                            </td>
                        </tr>
                    </table>
                    
                     <br>
                </td>
            </tr>
        @endforeach
       
       
    </tbody>
</table>






