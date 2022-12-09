<?php

declare(strict_types = 1);
/**
 * PSR-4 autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/data.php';

use App\View\ViewRenderer;
use App\Parser\CSVParser;

$viewRenderer = new ViewRenderer();
$parser = new CSVParser();

$url = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET') 
    {
     if (substr($url,0,strlen(PROCESS_URL)) === PROCESS_URL) {
            $parser->parseData($url);
            print($viewRenderer->renderView(PROCESS_PAGE));
            // process data

    } else  {
        print($viewRenderer->renderView(MAIN_PAGE));
    }
}




