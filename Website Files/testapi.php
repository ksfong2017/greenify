<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>

    <title>Greenify | Go Green!</title>
  </head>
  <body>

<?php

$mat_url = "https://jsonplaceholder.typicode.com/todos/10";
$mat_content = file_get_contents($mat_url);

echo $mat_content;

$mat_dataObj = json_decode($mat_content);
$mat_results = $mat_dataObj->result;

var_dump($mat_dataObj);


?>

</body>
</html>