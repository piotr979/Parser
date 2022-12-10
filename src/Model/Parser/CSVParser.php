<?php

namespace App\Model\Parser;

use App\Model\Parser\AbstractParser;
use App\Model\HTML\HtmlProcessor;

class CSVParser extends AbstractParser {

    private HtmlProcessor $htmlProcessor;
    private array $dataFromHtmlFile;
    public function __construct()
    {
      $this->htmlProcessor = new HtmlProcessor();
    }
    
    public function parseData(array $extractionData) {
    
      $this->openFile('wo_for_parse.html');
      $this->htmlProcessor->loadDoc($this->buffer);

      foreach ($extractionData as $item) {
        $dataFromHtmlFile[$item] = $this->htmlProcessor->getItemById($item);
      }
       $dataFromHtmlFile['scheduled_date'] = date('Y-m-d H:i', strtotime($dataFromHtmlFile['scheduled_date']));
      
      // following line removes dollar sign and replaces comma with no character
       $dataFromHtmlFile['nte'] = (float)str_replace(',','',substr($dataFromHtmlFile['nte'],1));
       
       $dataFromHtmlFile['location_phone'] = str_replace('-', '', $dataFromHtmlFile['location_phone']);
       $dataFromHtmlFile['location_address'] = trim($dataFromHtmlFile['location_address']);
   
      $fullAddress = $this->extractAddress($dataFromHtmlFile['location_address']);
    
      $dataFromHtmlFile = array_merge($dataFromHtmlFile,$fullAddress);

      unset($dataFromHtmlFile['location_address']);

      // data extracted from html file are ready.
      // time to convert to csv
      $csv = $this->convertArrayToCSV($dataFromHtmlFile);
      $this->downloadFile('wo_parsed.csv', $csv);

}

      // extracts address from the 'location_address'
      private function extractAddress(string $address): array
      {
        $addr = preg_replace('/\s+/', ' ', $address);
        preg_match("/(?<streetName>[a-zA-Z]+) street (\d+)\s*(?<cityName>[a-zA-Z]+) (?<state>[a-zA-Z]{2})\s*(?<zipCode>[0-9]+)/",
              $addr, $data);
        return [
            'streetName' => $data['streetName'],
            'cityName' => $data['cityName'],
            'state' => $data['state'],
            'zipCode' => $data['zipCode']
        ];
      }
      private function convertArrayToCSV(array $data): string
      {
        return implode(',', $data);
      }

}
