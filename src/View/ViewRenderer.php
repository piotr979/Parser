<?php

declare(strict_types=1);

namespace App\View;

class ViewRenderer {

    public function renderView(string $view)
    {
        ob_start();
        include __DIR__ . "/Template/Header.php";
        include __DIR__ . "/Template/{$view}";
        include __DIR__ . "/Template/Footer.php";
        return ob_get_clean();
    }
}