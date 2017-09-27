<?php
namespace App;

class Log
{

    private static $logFile;

    public static function write($string)
    {

        self::$logFile = storage_path() . '/logs/admin.log';

        if ($string) {
            $output = date("Y-m-d H:i:s") . ' ' . $_SESSION['name'] . ' ' . $string . "\r\n";
            file_put_contents(self::$logFile, $output, FILE_APPEND);
        } else {
            return false;
        }
    }
}
