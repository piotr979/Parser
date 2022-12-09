<?php

declare(strict_types = 1);
/**
 * PSR-4 autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';

use App\App;

$app = new App();

use App\Parser\CSVParser;
use App\View\ViewRenderer;



$view = "CustomerForm.php";
$viewRenderer = new ViewRenderer();

print($viewRenderer->renderView($view));





