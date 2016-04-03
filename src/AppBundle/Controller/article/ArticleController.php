<?php

namespace AppBundle\Controller\Article;

use AppBundle\Entity\Article\Article;
use AppBundle\form\Article\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name ="article_show")
     *
     * @param $id
     */
    public function showAction($id, Request $request)
    {
        $tag = $request->query->get('tag');
        return new Response('Article avec l\'id '.$id.' avec le tag: '.$tag);
    }

    /**
     * @Route("/list", name="article_list")
     */
    public function listAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $author = 'moi';

        $articles = $articleRepository->findBy([
            'author' => $author,
        ]);


        dump($articles) ;
        return new Response('List of articles');
    }


    /**
     * @Route("/new", name="article_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('article_list');
        }

        /*$article  = new Article();
         $article->setTitle('Osef du title')
                 ->setContent('Bonjour voici un test')
                 ->setTag('osef')
                 ->setAuthor('Moi')
                 ->setCreatedAt(new \DateTime());
        $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        */

        return $this->render('AppBundle:Article:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}