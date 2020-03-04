<?php

function removeEol($line)
{
    $line = ltrim($line, "\t\n\r\0\x0B");
    return rtrim($line, "\t\n\r\0\x0B");
}

// Добавление данных в конец файла. Если строка добавить просто на новую строку.
// Если массив то каждый новый элемент на новую строку
function addToFile(string $filename, $data)
{
    if (!file_exists($filename) || !is_file($filename))
        die("File '{$filename}' not found.");

    if (is_string($data)) {

        file_put_contents($filename, "\n" . $data, FILE_APPEND);


    } elseif (is_array($data)) {
        $res = "\n" . implode("\n", $data);
        file_put_contents($filename, $res, FILE_APPEND);

    }
}

// Преобразование данных из файла в массив. Вернуть сам массив.
function getFromFile($filename): array
{
    if (!file_exists($filename) || !is_file($filename))
        die("File '{$filename}' not found.");

    $lines = file($filename);
    $count = count($lines);
    if ($count == 0) {
        return [];
    }
    for ($i = 0; $i < $count; $i++) {
        $lines[$i] = removeEol($lines[$i]);
    }
    $res = str_split(implode("", $lines));
    return $res;

}

$str = "new";
addToFile('testLess05.txt', $str);

$arr = ["as", "bs", "cs"];
addToFile('testLess05.txt', $arr);

$res = getFromFile('testLess05.txt');
print_r($res);

