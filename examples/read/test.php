<?php

require '../../source/Csv.php';

$csv = new Csv();

$csv->open('test.csv');

$data = $csv->read();

var_dump($data);
