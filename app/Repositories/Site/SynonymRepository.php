<?php


namespace App\Repositories\Site;


use App\Http\Token\XWSSE;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SynonymRepository
{
    public $error = null;

    /**
     * @param string $mainWord
     * @param array $synonyms
     */
    public function serverRequest(string $mainWord, array $synonyms)
    {
        $url = "api.japancar.ru/synonym/add";

        try {
            $response = Http::withHeaders([
                'X-WSSE' => XWSSE::generate(),
            ])
                ->asForm()->post($url, [
                'main' => $mainWord,
                'synonyms' => $synonyms,
            ]);
        } catch (ConnectionException $e) {
            $this->error["other"] = "Сервис временно не доступен!";
            return $this->error;
        }

        $this->handleResponse($response);
        return $this->error;
    }

    /**
     * @param $res Response
     * @return string
     */
    public function handleResponse($res)
    {
        $statusCode = $res->status();
        $content = $res->body();

        if ($statusCode == 200) {
            $arr = json_decode($content, true);

            if (!empty($arr["msg"])) $this->error["other"] = $arr["msg"];
        }
    }
}