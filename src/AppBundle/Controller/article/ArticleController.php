<?php

namespace AppBundle\Controller\Article;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    /**
     * @Route("/{id}", requirements = {"id" = "\d+"})
     *
     * @param $id
     */
    public function showAction($id, Request $request)
    {
        $tag = $request->query->get('tag');
        return new Response('Article avec l\'id '.$id.' avec le tag: '.$tag);
    }

    /**
     * @Route("/list")
     */
    public function listAction()
    {
        return new Response('List of articles');
    }
}