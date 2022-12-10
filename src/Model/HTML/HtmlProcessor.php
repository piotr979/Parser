<?php

declare(strict_types=1);

namespace App\Model\HTML;
use DomDocument;

class HtmlProcessor {

    private $doc;

    public function __construct() 
    {
        $this->doc = new DomDocument;
    }
    public function loadDoc($buffer)
    {
        // if there are errors (like double id's) ignore them
        $this->doc->loadHTML($buffer, LIBXML_NOERROR);
    }
    public function getItemById(string $item): string
    {
        $domElement = $this->doc->getElementById($item);
        return $domElement->textContent;
    }

}