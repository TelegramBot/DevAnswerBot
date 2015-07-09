<?php

require_once "vendor/autoload.php";

try {
    $json = json_decode(file_get_contents("php://input"), true);
    $bot = new \TelegramBot\Api\BotApi('115769512:AAHrmO74I84DrmGmAezMBqS-vkQfhiU6fH0');

    $incomingMessage = \TelegramBot\Api\Types\Message::fromResponse($json['message']);

    if (in_array($incomingMessage->getText(), ['/devanswer'])) {
        preg_match_all('/{"text":"(.*?)",/s', file_get_contents('http://devanswers.ru/'), $result);

        $bot->sendMessage($incomingMessage->getChat()->getId(),
            str_replace("<br/>", "\n", json_decode('"' . $result[1][0] . '"')));
    }

} catch(\TelegramBot\Api\Exception $e) {
    echo $e->getMessage();
}

