<?php

header("Content-Type: text/plain; charset=UTF-8");

include "function.php";

$result = kgetcsv("en.csv");
print_r($result);

$result = kgetcsv("ru.csv",";","windows-1251");
print_r($result);

?>