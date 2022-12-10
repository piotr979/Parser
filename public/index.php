<?php

declare(strict_types = 1);
/**
 * PSR-4 autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/data.php';

// contains all fields required to be extracted (array)
require_once __DIR__ . '/../config/extractionData.php';

use App\View\ViewRenderer;
use App\Model\Parser\CSVParser;

$viewRenderer = new ViewRenderer();
$parser = new CSVParser();

$url = $_SERVER['REQUEST_URI'];

// Opens the main (index.php) page
// However if process.php is called parser is executed.
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
     if (substr($url,0,strlen(PROCESS_URL)) === PROCESS_URL) {
            $parser->parseData($extractionData);
    } else  {
        print($viewRenderer->renderView(MAIN_PAGE));
    }
}




