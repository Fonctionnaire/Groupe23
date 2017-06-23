<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{

    /**
     * @Route("/actualites", defaults={"page": "1", "_format"="html"}, name="actualites")
     * @Route("/actualites/page/{page}", defaults={"_format"="html"}, requirements={"page": "[0-9]\d*"}, name="actualites_paginated")
     * @Method("GET")
     */
    public function listArticlesAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        // On récupère notre objet Paginator
        $listArticles = $this->getDoctrine()->getManager()->getRepository('AppBundle:Article')
            ->getArticlesPaginated($page);

        // Si il n'y a pas d'articles on renvoit vers le formulaire d'ajout
        if (count($listArticles) < 1) {
            return $this->redirectToRoute('add');
        }

        // On calcule le nombre total de pages grâce au count($listArticles) qui retourne le nombre total d'articles
        $nbPages = ceil(count($listArticles) / Article::NUM_ITEMS);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        // On donne toutes les informations nécessaires à la vue
        return $this->render('Actualites/actualites.html.twig', array(
                'listArticles' => $listArticles,
                'nbPages' => $nbPages,
                'page' => $page,
            )
        );
    }

    /**
     * Display article content
     * @Route("/actualites/{slug}", name="view_article")
     * @Method("GET")
     */
    public function viewArticleAction(Article $article)
    {
        $listeComments = $this->getDoctrine()->getRepository("AppBundle:Comment")->findBy(
            array('article' => $article, 'level' => 1)
        );

        return $this->render(':Actualites:view.html.twig', array(
                'comments' => $listeComments,
                'article' => $article,
            )
        );
    }
}
