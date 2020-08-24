<?php

namespace App\Http\Token;

use App\Utils\Utils;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class XWSSE
{
    public static function generateXwsse()
    {
        $url = "http://api.japancar.ru/profile";
        $user = \Auth::user();
        $token = \Auth::token();
        $nonce = \Str::random(mt_rand(6, 12));

        $t = explode(" ", microtime());
        $dateFormat = 'Y-m-d H:i:s';
        $time = date($dateFormat, $t[1]).substr((string)$t[0],1,3);

        $digest = base64_encode(sha1($nonce . $time . $token, true));

        try {
            $response = Http::withHeaders([
                'X-WSSE' => 'X-WSSE: UsernameToken Username="'. $user .'", PasswordDigest="'. $digest
            .'", Nonce="'. $nonce .'", Created="'. $time . '"',
            ])->post($url);

        } catch (ConnectionException $e) {
            dd($e);
        }

        $res = $response->body();
        $result = Utils::getValidJsonFromApi($res);
    }

}