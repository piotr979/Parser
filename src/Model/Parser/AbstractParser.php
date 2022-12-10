<?php

namespace App\Model\Parser;

use App\HTML\HtmlProcessor;

/** 
 * Abstract parser as a foundation for any parser(s)
 */
abstract class AbstractParser {

    protected string $buffer;
    
    public function openFile($fileName) {
        $handle = fopen($fileName, "r");
        $this->buffer = fread($handle, filesize($fileName));
        fclose($handle);
    }
    public function removeChar(string $text, char $char): string
    {
        return str_replace($char, '', $text);
    }

    public function downloadFile(string $fileName, string $data) {
          // echo $this->buffer;

        file_put_contents($fileName, $data);
      
        if (file_exists($fileName)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
            readfile($fileName);
            
            
         }
    }
}