<?php


namespace App\Utils;


class Utils
{
    /**
     * @param $json
     * @return array
     */
    public static function getValidJsonFromApi($json) {
        return json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true );
    }
}