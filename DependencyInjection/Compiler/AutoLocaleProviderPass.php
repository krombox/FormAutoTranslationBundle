<?php

namespace Krombox\FormAutoTranslationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder;

class AutoLocaleProviderPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {                
        $localeProvider = $container->getParameter('krombox_form_auto_translation.locale_provider');

        if ('default' === $localeProvider) {
            $container->setAlias('krombox_form_auto_translation.default.locale_provider', 'krombox_form_auto_translation.default.service.parameter_locale_provider');

            $definition = $container->getDefinition('krombox_form_auto_translation.default.service.parameter_locale_provider');
            
            $definition->setArguments(array(
                $container->getParameter('a2lix_translation_form.locales'),
                $container->getParameter('a2lix_translation_form.default_locale'),
                $container->getParameter('a2lix_translation_form.required_locales'),
                $container->getParameter('krombox_form_auto_translation.auto_translated_locales')
            ));
            
        } else {
            $container->setAlias('krombox_form_auto_translation.default.service.locale_provider', $localeProvider);
        }
    }
}