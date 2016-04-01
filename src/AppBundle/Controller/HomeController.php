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

       /* $article  = new Article();
        $article->setTitle('Osef du title')
                ->setContent('Bonjour voici un test')
                ->setTag('osef')
                ->setCreatedAt(new \DateTime());

        $em->persist($article);
        $em->flush();*/

        $articles = $articleRepository->findAll();

        return new Response('Article creted');

    }
}
