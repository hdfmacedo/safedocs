<?php
require_once __DIR__ . '/../Common.php';
require_once __DIR__ . '/../Auth.php';

class BaseController {
    protected function render(string $view, array $params = []): void {
        extract($params, EXTR_SKIP);
        ob_start();
        require __DIR__ . '/../views/' . $view . '.php';
        $content = ob_get_clean();
        $dark = isset($_COOKIE['dark']) ? 'dark' : '';
        require __DIR__ . '/../views/layout.php';
    }
}
?>
