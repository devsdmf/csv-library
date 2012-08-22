<?php

require '../../source/Csv.php';

$csv = new Csv();

$csv->create('test.csv');

echo 'File has been created';
