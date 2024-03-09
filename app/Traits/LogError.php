<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait LogError {

    /**
     * @param $message
     * @param $stackTrace
     */
    public function LogError($message, $stackTrace) : void
    {
        $errorsLogPath = 'logs/ErrorLog.txt';
        $errorsLog = Storage::get($errorsLogPath);


        $errorsLog .= date('Y-m-d H:i:s') . ' - ' . $message . ' - Stack Trace:' . $stackTrace . PHP_EOL;


        Storage::put($errorsLogPath, $errorsLog);
    }
}

