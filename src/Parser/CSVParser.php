<?php

namespace App\Parser;

class CSVParser {
    public function parseData($data) {
    
        parse_str($_SERVER['QUERY_STRING'], $assocData);
        $assocData['scheduled_date'] = date('Y-m-d H:i', strtotime($assocData['scheduled_date']));
        
        // following line removes dollar sing and replaces comma with no character
        $assocData['nte'] = (float)str_replace(',','',substr($assocData['nte'],1));
        $assocData['location_phone'] = str_replace('-', '', $assocData['location_phone']);
        
        $csv = implode(',', $assocData);
        
        $fileName = 'data.csv';
        file_put_contents($fileName, $csv);
       
        if (file_exists($fileName)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
            readfile($fileName);
            exit;
        }

    }
}
