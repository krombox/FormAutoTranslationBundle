<?php

namespace Krombox\FormAutoTranslationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Krombox\FormAutoTranslationBundle\Form\EventListener\AutoTranslationsListener;
use Krombox\FormAutoTranslationBundle\Locale\AutoLocaleProviderInterface;
/**
 * @author Roman Kapustian <ikrombox@gmail.com>
 */
class AutoTranslationsType extends AbstractType {    
    
    private $autoTranslationsListener;
    
    private $autoLocaleProvider;
    
    public function __construct(AutoTranslationsListener $autoTranslationsListener, AutoLocaleProviderInterface $autoLocaleProvider)
    {
        $this->autoTranslationsListener = $autoTranslationsListener;
        $this->autoLocaleProvider = $autoLocaleProvider;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber($this->autoTranslationsListener);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {                
        $resolver->setDefaults(array(
            'attr' => array('data-autotranslate' => 'autotranslate'),
            'auto_translated_locales' => $this->autoLocaleProvider->getAutoTranslatedLocales()
        ));
    }

    public function getParent()
    {
        return 'a2lix_translations';
    }   

    public function getName()
    {
        return 'krombox_auto_translations';
    }
}
