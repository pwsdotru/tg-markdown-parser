<?php

/*
Array
(
    [0] => TelegramBot\Api\Types\MessageEntity Object
        (
            [type:protected] => bold
            [offset:protected] => 7
            [length:protected] => 4
            [url:protected] =>
            [user:protected] =>
            [language:protected] =>
            [customEmojiId:protected] =>
        )

    [1] => TelegramBot\Api\Types\MessageEntity Object
        (
            [type:protected] => italic
            [offset:protected] => 32
            [length:protected] => 3
            [url:protected] =>
            [user:protected] =>
            [language:protected] =>
            [customEmojiId:protected] =>
        )

    [2] => TelegramBot\Api\Types\MessageEntity Object
        (
            [type:protected] => text_link
            [offset:protected] => 59
            [length:protected] => 4
            [url:protected] => http://stie.com/url
            [user:protected] =>
            [language:protected] =>
            [customEmojiId:protected] =>
        )

)
*/
$entities = [
    [
        'type' => 'bold',
        'offset' => 7,
        'length' => 4,
        'url' => '',
    ],
    [
        'type' => 'italic',
        'offset' => 32,
        'length' => 3,
        'url' => '',
    ],
    [
    'type' => 'text_link',
    'offset' => 59,
    'length' => 4,
    'url' => 'http://site.com/url',
    ],
];
