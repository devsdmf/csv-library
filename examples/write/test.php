<?php

require '../../source/Csv.php';

$csv = new Csv();

$csv->open('test.csv');

$data = array('value1','value2');

$csv->write($data);

echo 'Data written to the file';
