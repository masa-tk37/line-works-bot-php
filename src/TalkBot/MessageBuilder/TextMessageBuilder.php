<?php

namespace Apricot\LineWorks\TalkBot\MessageBuilder;

use Apricot\LineWorks\TalkBot\MessageBuilder;
use Apricot\LineWorks\Utility\LocaleUtility;

class TextMessageBuilder implements MessageBuilder
{
    /**
     * @var array
     */
    private $content = [];

    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $i18nTexts = [];

    public function __construct($text, array $i18nTexts = [])
    {
        $this->text = $text;
        foreach ($i18nTexts as $locale => $i18nText) {
            if (! LocaleUtility::isAcceptable($locale)) {
                continue;
            }
            $this->i18nTexts[] = [
                'language' => $locale,
                'text' => $i18nText,
            ];
        }
    }

    public function build()
    {
        if (! empty($this->content)) {
            return $this->content;
        }

        $this->content = [
            'type' => 'text',
            'text' => $this->text,
        ];
        if (! empty($this->i18nTexts)) {
            $this->content['i18nTexts'] = $this->i18nTexts;
        }
        return $this->content;
    }
}
