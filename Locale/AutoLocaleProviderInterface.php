<?php

namespace Krombox\FormAutoTranslationBundle\Locale;

use A2lix\TranslationFormBundle\Locale\LocaleProviderInterface;
/**
 * @author Roman Kapustian <ikrombox@gmail.com>
 */
interface AutoLocaleProviderInterface extends LocaleProviderInterface
{
    /**
     * Get autotranslated locales
     *
     * @return array
     */
    public function getAutoTranslatedLocales();
    
}
