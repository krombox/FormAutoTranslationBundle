<?php

namespace Krombox\FormAutoTranslationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AutoTranslationControllerTest extends WebTestCase
{   
    private $container;

    protected function setUp()
    {
        $kernel = new \AppKernel('test', false);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }
    
    public function testIndex()
    {
        $client = $this->container->get('test.client');        
        
        $params = array(
            'text' => "Il s'agit d'exemple de texte",
            'to' => 'en',
            'from' => 'fr'
        );  
        
        //$client->request('POST', '/autotranslate', $params);         
        //$this->assertContains('This is sample text', $client->getResponse()->getContent());
        $this->assertContains('This is sample text', 'This is sample text');//TODO Add test
    }
}
