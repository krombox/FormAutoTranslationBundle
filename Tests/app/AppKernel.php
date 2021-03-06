<?php
// File: Tests/app/AppKernel.php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Krombox\FormAutoTranslationBundle\KromboxFormAutoTranslationBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),
            new MatthiasNoback\MicrosoftTranslatorBundle\MatthiasNobackMicrosoftTranslatorBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }
}