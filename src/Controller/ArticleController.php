<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction(ViewArticleHandler $articleHandler, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Article::class);
        $article = $repository->findOneBy(array('slug'=>$slug));
        return $this->render("Article/show.html.twig", array("article"=>$article));
    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(NewArticleHandler $articleHandler, Request $request)
    {
        // Seul les auteurs doivent avoir access.
        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $articleHandler->handle($article);
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute("article_show",array("slug"=>$article->getSlug()));
        }
        return $this->render('Article/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction()
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier
    }
}
