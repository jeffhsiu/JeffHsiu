<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    /**
     * 生成二維碼
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author Jeff Lin
     */
    public function createQrcode(Request $request)
    {
        $format = $request->img_format ?: 'png';
        $size = $request->size ?: 400;
        $margin = $request->size ?: 1;
        $text = $request->text ?: 'http://www.jeffhsiu.com';
        $error = 'H';

        $qrcode = QrCode::format($format)
            ->size($size)
            ->margin($margin)
            ->errorCorrection($error)
            ->merge('/public/images/fastrabbit.png', .2)
            ->generate($text);

        return response($qrcode)->header('Content-Type','image/png');
    }
}
