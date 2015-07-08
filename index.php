<?php

require_once('vendor/autoload.php');


try {
    $json = json_decode(file_get_contents("php://input"), true);
    $bot = new \TelegramBot\Api\BotApi('115769512:AAHrmO74I84DrmGmAezMBqS-vkQfhiU6fH0');

    $incomingMessage = \TelegramBot\Api\Types\Message::fromResponse($json['message']);

    if($incomingMessage->getText() === '/ping') {
        $bot->sendMessage($incomingMessage->getChat()->getId(), 'pong!');
    }

} catch(\TelegramBot\Api\Exception $e) {
    echo $e->getMessage();
}