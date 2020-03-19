<?php

namespace Apricot\LineWorks\Utility;

class LocaleUtility
{
    public static function isAcceptable($locale)
    {
        return in_array($locale, ['ja_JP', 'ko_KR', 'zh_CN', 'zh_TW', 'en_US']);
    }
}
