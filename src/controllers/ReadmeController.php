<?php
require_once __DIR__ . '/BaseController.php';

class ReadmeController extends BaseController {
    public function show(): void {
        $user = Auth::user();
        $path = __DIR__ . '/../../README.md';
        $readme = file_exists($path) ? file_get_contents($path) : 'README not available.';
        Logger::info($user['username'] ?? 'guest', 'readme', 'Viewed README');
        $this->render('readme', ['readme' => $readme, 'user' => $user, 'title' => 'README']);
    }
}
?>
