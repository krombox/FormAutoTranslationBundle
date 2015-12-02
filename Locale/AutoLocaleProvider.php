<?php

/**
 * @author Roman Kapustian <ikrombox@gmail.com>
 */

namespace Krombox\FormAutoTranslationBundle\Locale;

use A2lix\TranslationFormBundle\Locale\DefaultProvider;

class AutoLocaleProvider extends DefaultProvider implements AutoLocaleProviderInterface 
{
    /**
     * Auto translated locales
     *
     * @var array
     */
    protected $autoTranslatedLocales;
    
    public function __construct(array $locales, $defaultLocale, array $requiredLocales = array(), array $autoTranslatedLocaes = array())
    {  
        parent::__construct($locales, $defaultLocale, $requiredLocales);
        
        if (array_diff($autoTranslatedLocaes, $locales)) {
            throw new \InvalidArgumentException('Auto translated locales should be contained in locales');
        }

        $this->autoTranslatedLocales = $autoTranslatedLocaes;
    }        
    
    /**
     * {@inheritdoc}
     *
     */
    public function getAutoTranslatedLocales()
    {
        return $this->autoTranslatedLocales;
    }
}
