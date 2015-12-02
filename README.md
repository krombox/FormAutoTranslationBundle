# FormAutoTranslationBundle

Add a possibility to autotranslate form fields on button click. New form type: ``krombox_auto_translations``.

## Requirements

- Symfony 2.2
- [KnpLabs/DoctrineBehaviors](https://github.com/KnpLabs/DoctrineBehaviors)
- [A2lixTranslationFormBundle](https://github.com/a2lix/TranslationFormBundle)(auto installed from composer)
- [MicrosoftTranslatorBundle](https://github.com/matthiasnoback/MicrosoftTranslatorBundle) (auto installed from composer)

## Installation

Add the repository to your composer.json

    "krombox/form-auto-translation-bundle": "dev-master"

Run Composer to install the bundle

    php composer.phar update krombox/form-auto-translation-bundle
    
Add to AppKernel
Register the bundle in ``/app/AppKernel.php``:

    <?php

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Krombox\FormAutoTranslationBundle\KromboxFormAutoTranslationBundle()
            );
        }
    }

    
## Configuration Referance

Configure the bundle in ``app/config.yml``:
    
    a2lix_translation_form:
        locale_provider: default       
        locales: [ru, en, fr, uk]     
        default_locale: en            
        required_locales: [ru, en]
        manager_registry: doctrine
        templating: "A2lixTranslationFormBundle::default.html.twig"
    
    matthias_noback_microsoft_translator:
        oauth:
            client_id: **********************
            client_secret: *******************    

    krombox_form_auto_translation:
        auto_translated_locales: [ru, en, fr, uk]
        locale_provider: default
        templating: "KromboxFormAutoTranslationBundle::default.html.twig"
        
Configure the bundle in ``app/routing.yml``:

    krombox_form_auto_translation: 
        resource: "@KromboxFormAutoTranslationBundle/Resources/config/routing.yml"
        
Template must contains bootstrap and fontAwasome for standart way view. So, add them somehow you prefer:

    {% block stylesheets %}
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />            
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">        
    {% endblock %}
        
Include javascripts template and init autotranslate plugin:

    {% block javascripts %}    
        {% include 'KromboxFormAutoTranslationBundle::javascripts.html.twig' %}
        <script>                                               
            $(document).ready(function(){                                                
                $('.autotranslatable').autotranslate();                                                
            });
        </script>
    {% endblock %}
    
##Usage

Now you can use new form type ``krombox_auto_translations``:

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'krombox_auto_translations')    
            ...
        ;
    }

    