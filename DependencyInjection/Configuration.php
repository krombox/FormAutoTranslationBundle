<?php

namespace Krombox\FormAutoTranslationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('krombox_form_auto_translation');
        
        $rootNode
            ->children()
                ->scalarNode('locale_provider')->defaultValue('default')->end()
                ->scalarNode('templating')->defaultValue('KromboxFormAutoTranslationBundle::default.html.twig')->end()
                ->arrayNode('auto_translated_locales')                    
                    ->beforeNormalization()
                        ->ifString()
                        ->then(function($v) { return preg_split('/\s*,\s*/', $v); })
                    ->end()
                    ->prototype('scalar')->end()
                ->end()                               
            ->end()
        ;        

        return $treeBuilder;
    }
}
