<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    private static $logFile = __DIR__ . '/../storage/logs/admin.log';

    public static function write($string)
    {

        if ($string) {
            $output = date("Y-m-d H:i:s") . ' ' . $_SESSION['name'] . ' ' . $string . "\r\n";
            file_put_contents(self::$logFile, $output, FILE_APPEND);
        } else {
            return false;
        }
    }
}
