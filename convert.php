<?php


function convertCurr($amount, $from, $to){
	$data = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to"); // read data after pushing data to google
	preg_match("/<span class=bld>(.*)<\/span>/",$data, $divdt); // extract required data
	$divdt = preg_replace("/[^0-9.]/", "", $divdt[1]);
	return number_format(round($divdt, 3),2); 
}
$amount = $_POST["amt"];
$from = 'USD';
$to = 'BDT';
$currency = convertCurr($amount, $from, $to);

 echo $currency;

// @URL: phpgroup.org
?>