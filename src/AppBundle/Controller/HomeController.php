<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        /*$antispam = $this->get('antispam');

        dump($antispam->isSpam('EAZEAZEAZEAZEAZEAZEAZE'));die;

        $name = "Symfony 3";

        $tutorials = [
            [
                'id'=> 2,
                'name'=> 'Symfony 2'
            ],
            [
                'id' => 5,
                'name' => 'Laravel'
            ],
            [
                'id' => 9,
                'name' => 'Wordpress'
            ],

        ];

        return $this->render('AppBundle:Home:index.html.twig', [
            'name' => $name,
            'tutorials' => $tutorials,
        ]);*/

        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();

        dump($articles);

        return $this->render('AppBundle:Home:index.html.twig', [
            'articles' => $articles,
        ]);

    }
}
