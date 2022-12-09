<?php

declare(strict_types = 1);
/**
 * PSR-4 autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/data.php';

use App\View\ViewRenderer;

$viewRenderer = new ViewRenderer();

$url = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET') 
    {
     if ($url == '/process') {
            print($viewRenderer->renderView(PROCESS_PAGE));
    } else {
        print($viewRenderer->renderView(MAIN_PAGE));
    }
}




