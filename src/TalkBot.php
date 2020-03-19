<?php

namespace Apricot\LineWorks;

use Apricot\LineWorks\HttpClient;
use Apricot\LineWorks\TalkBot\MessageBuilder;

class TalkBot
{
    const API_BASE_URI = 'https://apis.worksmobile.com';

    /**
     * @var \Apricot\LineWorks\HttpClient
     */
    private $client;

    /**
     * @var string
     */
    private $apiId;

    /**
     * @var string
     */
    private $botNo;

    public function __construct(array $args)
    {
        $this->apiId = $args['apiId'];
        $this->client = new HttpClient($args['consumerKey'], $args['token']);

        if (array_key_exists('botNo', $args)) {
            $this->botNo = $args['botNo'];
        }
    }

    public function setBotNo($botNo)
    {
        $this->botNo = $botNo;
    }

    public function sendToAccount($accountId, MessageBuilder $messageBuilder)
    {
        return $this->client->post(self::API_BASE_URI . '/r/' . $this->apiId . '/message/v1/bot/' . $this->botNo . '/message/push', [
            'accountId' => $accountId,
            'content' => $messageBuilder->build(),
        ]);
    }

    public function sendToRoom($roomId, MessageBuilder $messageBuilder)
    {
        return $this->client->post(self::API_BASE_URI . '/r/' . $this->apiId . '/message/v1/bot/' . $this->botNo . '/message/push', [
            'roomId' => $roomId,
            'content' => $messageBuilder->build(),
        ]);
    }
}
