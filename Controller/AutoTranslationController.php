<?php

namespace Krombox\FormAutoTranslationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoTranslationController extends Controller
{
    public function translateAction(Request $request)
    {        
        $params = $request->request->all();        
        $translatedString = $this->get('microsoft_translator')->translate($params['text'], $params['to'], $params['from']);
        
        return new Response($translatedString, Response::HTTP_OK);        
    }  
}
