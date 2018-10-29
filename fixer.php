<?php

$DEBUG = true;

// import file
$filename = "History.csv";
$input = file_get_contents($filename);


// parse data
 $delimiter = ",";
$enclosure = "\"";

$data = str_getcsv($input, "\n"); //parse the rows 
foreach($data as &$Row) $Row = str_getcsv($Row, $delimiter); //parse the items in rows 

if($DEBUG) print_r($data);

// fix columns
$final = array();

//condition first line of spreadsheet
$final[] = "Date,Payee,Category,Memo,Outflow,Inflow" . "\n";

if($DEBUG) print_r($final);

//clear last row - empty
//unset($data[count($data) - 1]);
//clear first row - bad columns
unset($data[0]);

foreach($data as $row)
{
    $final[] = $row[1] . "," . str_replace("Point Of Sale Withdrawal", "POS - ", $row[7]) . "," . "" . "," . $row[6] . "," . "" . "," . $row[2] . "\n";
}

if($DEBUG) print_r($final);


// export (save) file

$save_file = "history_fixed.csv";

file_put_contents($save_file, $final);

?>