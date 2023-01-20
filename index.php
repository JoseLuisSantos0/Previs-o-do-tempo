<?php

session_start();

$localizacao = json_decode(file_get_contents("https://api.hgbrasil.com/geoip?key=e64c063d&address=remote&precision=false"));
$localizacao = $localizacao->results;

$locaUser = "$localizacao->city, $localizacao->region";
$enderecoip = $localizacao->address;


$api = json_decode(file_get_contents("https://api.hgbrasil.com/weather?key=e64c063d&user_ip=$enderecoip"));
$api = $api->results;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previsão do Tempo</title>
    <style> 
        table, th, td { 
        border: 1px solid black; 
        border-collapse: collapse; 
        } 
        th, td { 
        padding: 15px; 
        } 
  </style>
</head>
<body>

  <h1>Sua Cidade: <?= $locaUser ?> </h1>
  <table style="width:100%"> 
    <caption>
      <h1>Previsão do Tempo</h1>
      <h3>Dos próximos dias</h3>
    </caption>
    <tr> 
      <th>Data</th> 
      <th>Temperatura Mínima</th> 
      <th>Temperatura Máxima</th> 
      <th>Descrição</th> 
      <th>Probabilidade de chuva</th> 
    </tr>
    <? foreach($api->forecast as $proxDatas): ?> 

      <tr> 
        <td><?= $proxDatas->date . ' - ' . $proxDatas->weekday ?></td> 
        <td><?= $proxDatas->min . '°C' ?></td> 
        <td><?= $proxDatas->max . '°C' ?></td> 
        <td><?= $proxDatas->description ?></td> 
        <td><?= $proxDatas->rain_probability . '%' ?></td> 
      </tr>

    <? endforeach ?> 
     
  </table>     
</body>
</html>


