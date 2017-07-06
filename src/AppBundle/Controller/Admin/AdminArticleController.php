<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminArticleController extends Controller
{

     /**
     * view all articles on admin page
     * @Route("/admin/actualites", name="adminActualites")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewArticlesAction()
    {
        $listArticles = $this->getDoctrine()->getRepository("AppBundle:Article")->findAll();
        return $this->render('Admin/actualites.html.twig', array('listArticles' => $listArticles));
    }

    /**
     * Display form to add a NEW article
     * @Method({"GET", "POST"})
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/actualites/add", name="add")
     */
    public function addAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $request->getSession()->getFlashbag()->add('success', 'Le nouvel article a été enregistré.');
            return $this->redirectToRoute('view_article', array('slug' => $article->getSlug()));
        }
        return $this->render(
            'Actualites/add.html.twig', array('form' => $form->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/actualites/{slug}/edit", name="editArticle")
     */
    public function editAction(Article $article, Request $request)
    {
        $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        $formEdit = $this->createForm(ArticleType::class, $article);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Article modifié avec succès');
            return $this->redirect($this->generateUrl('view_article', array('slug' => $article->getSlug())));

        }
        return $this->render(
            'Actualites/edit.html.twig', [
                'article' => $article,
                'form' => $formEdit->createView(),
            ]
        );
    }

    /**
     * Delete Article
     * @Route("/actualites/{slug}/delete", name="deleteArticle")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     */
    public function deleteAction(Article $article, Request $request)
    {
        $referer = $request->headers->get('referer');

        if ($this->getDoctrine()->getRepository("AppBundle:Article")->countAll() > 1) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();

            $this->addFlash('success', 'Article Supprimé avec succès');

            if ($referer == $this->get('router')->generate('view_article', array('slug' => $article->getSlug()))) {
                return $this->redirectToRoute('actualites');
            } else {
                return $this->redirect($referer);
            }
        } else {
            $this->addFlash('alert', 'Vous ne pouvez pas supprimer le dernier article !');

            return $this->redirect($referer);
        }
    }
}
