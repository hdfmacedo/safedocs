<?php
class Logger {
    private static function log($level, $user, $action, $message) {
        $date = date('c');
        $entry = "$date [$level] user:$user action:$action message:$message\n";
        file_put_contents(__DIR__ . '/../storage/app.log', $entry, FILE_APPEND);
    }

    public static function info($user, $action, $message) {
        self::log('INFO', $user, $action, $message);
    }

    public static function error($user, $action, $message) {
        self::log('ERROR', $user, $action, $message);
    }
}
?>
