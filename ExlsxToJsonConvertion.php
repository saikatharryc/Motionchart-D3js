<?php

require_once 'classes/PHPExcel/IOFactory.php';

$excel = PHPExcel_IOFactory::load("Motion Dashboard.xlsx");
$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
$writer->setDelimiter(",");
$writer->setEnclosure("");
$writer->setLineEnding("\r\n");
$writer->setSheetIndex(0);
$writer->save("sap.csv");


function getJsonFromCsv($file,$delimiter) { 
    if (($handle = fopen($file, 'r')) === false) {
        die('Error opening file');
    }

    $headers = fgetcsv($handle, 4000, $delimiter);
    $csv2json = array();

    while ($row = fgetcsv($handle, 4000, $delimiter)) {
      $csv2json[] = array_combine($headers, $row);
    }

    fclose($handle);
    return json_encode($csv2json); 
}

$file = 'sap.csv';
echo getJsonFromCsv($file, ',');
?>
