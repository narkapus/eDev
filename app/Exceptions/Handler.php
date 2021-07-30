<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            switch ($statusCode) {
                case '400':
                    $messageEN = "BAD REQUEST";
                    $messageTH = "การแสดงผลผิดพลาด";
                    break;
                case '401':
                    $messageEN = "UNAUTHORIZED ACCESS";
                    $messageTH = "การเข้าถึงระบบโดยไม่ได้รับอนุญาต";
                    break;
                case '402':
                    $messageEN = "FUNCTION IS NOT READY";
                    $messageTH = "ฟังก์ชั่นนี้ยังไม่พร้อมให้ใช้งาน";
                    break;
                case '403':
                    $messageEN = "ACCESS DENIED/FORBIDDEN";
                    $messageTH = "คุณไม่มีสิทธิ์เข้าถึงหน้าเว็บไซต์นี้";
                    break;
                case '404':
                    $messageEN = "PAGE NOT FOUND";
                    $messageTH = "ไม่พบหน้าเว็บไซต์นี้";
                    break;
                case '405':
                    $messageEN = "Method Not Allowed";
                    $messageTH = "เซิร์ฟเวอร์ไม่รู้จัก Request Methods ที่ร้องขอมา";
                    break;
                case '500':
                    $messageEN = "INTERNAL SERVER ERROR";
                    $messageTH = "พบบางอย่างผิดพลาด";
                    break;
                case '503':
                    $messageEN = "SERVICE UNAVAILABLE";
                    $messageTH = "เว็บไซต์อยู่ในระหว่างการปรับปรุงระบบ";
                    break;
                default:
                    $messageEN = '';
                    $messageTH = '';
            }

            $error = array(
                'statusCode'    => $statusCode,
                'messageEN'     => $messageEN,
                'messageTH'     => $messageTH
            );
            return response()->view('errors.error', compact('error'));
        }

        return parent::render($request, $exception);
    }
}
