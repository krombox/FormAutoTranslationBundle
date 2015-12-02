<?php

namespace Krombox\FormAutoTranslationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Krombox\FormAutoTranslationBundle\DependencyInjection\Compiler\AutoLocaleProviderPass;
use Krombox\FormAutoTranslationBundle\DependencyInjection\Compiler\TemplatingPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class KromboxFormAutoTranslationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);        
        $container->addCompilerPass(new TemplatingPass());
        $container->addCompilerPass(new AutoLocaleProviderPass());       
    }
}
