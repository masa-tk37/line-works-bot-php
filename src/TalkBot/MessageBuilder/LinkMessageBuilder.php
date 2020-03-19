<?php

namespace Apricot\LineWorks\TalkBot\MessageBuilder;

use Apricot\LineWorks\TalkBot\MessageBuilder;
use Apricot\LineWorks\Utility\LocaleUtility;

class LinkMessageBuilder implements MessageBuilder
{
    /**
     * @var array
     */
    private $content = [];

    /**
     * @var string
     */
    private $contentText;

    /**
     * @var string
     */
    private $linkText;

    /**
     * @var string
     */
    private $link;

    /**
     * @var array
     */
    private $i18nContentTexts = [];

    /**
     * @var array
     */
    private $i18nLinkTexts = [];

    public function __construct($link, array $texts, array $i18nTexts = [])
    {
        $this->link = $link;
        $this->contentText = $texts['contentText'];
        $this->linkText = $texts['linkText'];
        foreach ($i18nTexts as $locale => $i18nText) {
            if (! LocaleUtility::isAcceptable($locale)) {
                continue;
            }
            $this->i18nContentTexts[] = [
                'language' => $locale,
                'contentText' => $i18nText['contentText'],
            ];
            $this->i18nLinkTexts[] = [
                'language' => $locale,
                'linkText' => $i18nText['linkText'],
            ];
        }
    }

    public function build()
    {
        if (! empty($this->content)) {
            return $this->content;
        }

        $this->content = [
            'type' => 'link',
            'contentText' => $this->contentText,
            'linkText' => $this->linkText,
            'link' => $this->link,
        ];
        if (! empty($this->i18nContentTexts)) {
            $this->content['i18nContentTexts'] = $this->i18nContentTexts;
        }
        if (! empty($this->i18nLinkTexts)) {
            $this->content['i18nLinkTexts'] = $this->i18nLinkTexts;
        }
        return $this->content;
    }
}
