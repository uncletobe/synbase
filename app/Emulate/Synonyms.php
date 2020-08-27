<?php


namespace App\Emulate;


class Synonyms
{
    public $synonyms = [
            [
                'mainWord' => 'Мопед',
                'synonyms' => [
                    'Дырчик',
                    'Мокик',
                    'Скутер',
                    'Мотик'
                ],
                'state' => 'check',
                'editable' => '',
            ],

            [
                'mainWord' => 'Toyota',
                'synonyms' => [
                    'Тойота',
                    'Тайота',
                    'Тоёта',
                    'Таёта',
                    'Таета',
                    'Тоета',
                ],
                'state' => 'success',
                'editable' => '',
            ],

            [
                'mainWord' => 'Лялял',
                'synonyms' => [
                    'Тополя',
                    'Три рубля',
                    'У ля ля',
                ],
                'state' => 'canceled',
                'editable' => '',
            ],
        ];


    public function __construct()
    {
        for ($i = 0; $i < count($this->synonyms); $i++) {
            $this->synonyms[$i]['editable'] = (time() + rand(20000, 86400)) * 1000;
        }
    }

    public function getFromDB()
    {
        return $this->synonyms;
    }
}