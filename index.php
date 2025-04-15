<!-- <!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>One page site PHP</title>
</head>

<body></body>

</html> -->

<?php
echo "It's my project" . "<br>";

// Задание 1
$name = 'олег';
$surname = 'доля';
$patronomyc = 'альбертович';

echo mb_convert_case($surname, MB_CASE_TITLE, "UTF-8") . ' ' .
    mb_strtoupper(mb_substr($name, 0, 1)) . '.' .
    mb_strtoupper(mb_substr($patronomyc, 0, 1)) . '.' . "<br>";

// Задание 2
$year = 2021;

for ($month = 1; $month <= 12; $month++) {
    for ($day = 1; $day <= 20; $day++) {
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        if (date('N', $timestamp) == 6) {
            echo date('d.m.Y', $timestamp) . "<br>";
        }
    }
}
?>