<?php

//declare(strict_types=1);

//use App\Parser\CSVParser;



//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(!is_array($decoded)){
    throw new Exception('Received content contained invalid JSON!');
} else {
   
    $file = 'datazs.csv';
    $current = file_get_contents($file);
    $data = implode(",", $decoded['data']);
    file_put_contents($file, $data);
  

}

