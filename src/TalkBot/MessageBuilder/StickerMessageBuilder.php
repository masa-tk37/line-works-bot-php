<?php

namespace Apricot\LineWorks\TalkBot\MessageBuilder;

use Apricot\LineWorks\TalkBot\MessageBuilder;

class StickerMessageBuilder implements MessageBuilder
{
    /**
     * @var array
     */
    private $content = [];

    /**
     * @var string
     */
    private $packageId;

    /**
     * @var string
     */
    private $stickerId;

    public function __construct($packageId, $stickerId)
    {
        $this->packageId = $packageId;
        $this->stickerId = $stickerId;
    }

    public function build()
    {
        if (! empty($this->content)) {
            return $this->content;
        }

        $this->content = [
            'type' => 'sticker',
            'packageId' => $this->packageId,
            'stickerId' => $this->stickerId,
        ];
        return $this->content;
    }
}
