<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Desafio 004</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Conversor de moedas v2.0</h1>
        <?php
            $inicio = date("m-d-Y", strtotime("-7 days"));
            $fim = date("m-d-Y");
            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $inicio . '\'&@dataFinalCotacao=\'' . $fim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            $data = json_decode(file_get_contents($url), true); 

            $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
            $cotacao = $data["value"][0]["cotacaoCompra"];
            $money = $_GET['money'];
            $dolar = $money / $cotacao;
           
            echo "<p>Seus  " . numfmt_format_currency($padrao, $money, "BRL") . " equivalem a <strong>" . numfmt_format_currency($padrao, $dolar, "USD") . "</strong></p>";
            echo "<p>Cotação obtida diretamente do site do <a href=\"https://dadosabertos.bcb.gov.br/\">Banco Central do Brasil</a></p>";
            echo "<p>A cotação do dia é de " . numfmt_format_currency($padrao, $cotacao, "BRL") . "</p>"; 

            

            echo "<input type=\"button\" value=\"Voltar\" onClick=\"history.go(-1)\">";
        ?>
    </main>
</body>
</html>