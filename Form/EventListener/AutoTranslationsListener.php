<?php

namespace Krombox\FormAutoTranslationBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent,
    Symfony\Component\Form\FormEvents,
    Symfony\Component\EventDispatcher\EventSubscriberInterface,
    A2lix\TranslationFormBundle\TranslationForm\TranslationForm;
use A2lix\TranslationFormBundle\Form\EventListener\TranslationsListener;

/**
 * @author Roman Kapustian <ikrombox@gmail.com>
 */
class AutoTranslationsListener extends TranslationsListener 
{
    protected $translationForm;
    
    public function __construct(TranslationForm $translationForm) {
        parent::__construct($translationForm);
        $this->translationForm = $translationForm;
    }

    /**
     *
     * @param \Symfony\Component\Form\FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        
        $translatableClass = $form->getParent()->getConfig()->getDataClass();
        $translationClass = $this->getTranslationClass($translatableClass);
        $formOptions = $form->getConfig()->getOptions();        
        $fieldsOptions = $this->translationForm->getFieldsOptions($translationClass, $formOptions);
        foreach ($formOptions['locales'] as $locale) {            
            if (isset($fieldsOptions[$locale])) {                
                $form->add($locale, 'a2lix_translationsFields', array(
                    'data_class' => $translationClass,
                    'fields' => $fieldsOptions[$locale],
                    'required' => in_array($locale, $formOptions['required_locales']),
                    'attr' => ['class' => (in_array($locale, $formOptions['auto_translated_locales']) ? 'autotranslatable' : '')]
                ));
            }
        }
    }
    
    /**
     *
     * @param string $translatableClass
     */
    private function getTranslationClass($translatableClass)
    {
        // Knp
        if (method_exists($translatableClass, "getTranslationEntityClass")) {
            return $translatableClass::getTranslationEntityClass();
        
        // Gedmo    
        } elseif (method_exists($translatableClass, "getTranslationClass")) {
            return $translatableClass::getTranslationClass();
        }
        
        return $translatableClass .'Translation';
    }
}
