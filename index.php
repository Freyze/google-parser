<?php
// создание нового cURL ресурса
$ch = curl_init();

//$url = $argv[1];
$query = $_GET['query'];
$query = str_replace(' ', '+', $query);
$url = 'https://www.google.com/search?q=' . $query;

// установка URL и других необходимых параметров
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36');

// загрузка страницы и выдача её браузеру
$result = curl_exec($ch);
var_dump($result);

$reg = '/<div class="r"><a\s*href="(?<url>[^"]+)".*?<h3\s*class="[^"]+">(?<caption>[^<]+).*?<\/div>/'; // https://regex101.com/r/qIoucI/2/

if (preg_match_all($reg, $result, $matches)) {

    for ($i = 0; $i < count($matches[0]); $i++) {

        echo "<br>URL: ".$matches["url"][$i];
        echo "<br>Caption: ".$matches["caption"][$i];

    }

}
// завершение сеанса и освобождение ресурсов
curl_close($ch);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;500&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
<div class="wrapper">

    <form method="get">
        <h1>Parser</h1>
        <input type="text" placeholder="Введите запрос" name="query">
        <button type="submit">Спарсить</button>
    </form>
</div>
</body>
</html>