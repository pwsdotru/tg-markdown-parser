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
            [type:protected] => underline
            [offset:protected] => 23
            [length:protected] => 6
            [url:protected] =>
            [user:protected] =>
            [language:protected] =>
            [customEmojiId:protected] =>
        )

    [2] => TelegramBot\Api\Types\MessageEntity Object
        (
            [type:protected] => text_link
            [offset:protected] => 53
            [length:protected] => 9
            [url:protected] => http://test.com/
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
        'type' => 'underline',
        'offset' => 23,
        'length' => 6,
        'url' => '',
    ],
    [
    'type' => 'text_link',
    'offset' => 53,
    'length' => 9,
    'url' => 'http://test.com/',
    ],
];
