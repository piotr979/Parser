<?php

namespace App\Parser;

class CSVParser {
    public function __construct($data) {
        $file = 'data.csv';
        $current = file_get_contents($file);
        $data = implode(",", $decoded['data']);
        file_put_contents($file, $data);
    }
}
