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
     * @Route("/show/{id}", requirements = {"id" = "\d+"}, name ="article_show")
     *
     * @param $id
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $article = $articleRepository->find($id);

        return $this->render('AppBundle:Article:single.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/list", name="article_list")
     */
    public function listAction(Request $request)
    {
        $tag = $request->query->get('tag');
        if ($tag == "") {
            $em = $this->getDoctrine()->getManager();
            $articleRepository = $em->getRepository('AppBundle:Article\Article');



            $articles = $articleRepository->findBy(array(), array('createdAt' => 'DESC'));

            return $this->render('AppBundle:Article/Partial:list.html.twig', [
                'articles' => $articles,
            ]);
        } else {
            $em = $this->getDoctrine()->getManager();
            $articleRepository = $em->getRepository('AppBundle:Article\Article');

            $tag = $request->query->get('tag');

            $articles = $articleRepository->findBy([
                'tag' => $tag,
            ]);

            return $this->render('AppBundle:Article/Partial:list.html.twig', [
                'articles' => $articles,
            ]);
        }

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

        return $this->render('AppBundle:Article:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}