<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use AppBundle\Form\ArticleEditType;
use AppBundle\Form\ImageEditType;
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

            if($article->getImage()){
                $file = $article->getImage();
                $fileName = $this->get('app.image_uploader')->upload($file);
                $article->setImage('uploads/images/' . $fileName);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $request->getSession()->getFlashbag()->add('success', 'Le nouvel article a été enregistré.');

            return $this->redirectToRoute('view_article', array('slug' => $article->getSlug()));
        }

        return $this->render(
            'Actualites/add.html.twig',
            array(
                'form' => $form->createView(),
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
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        $formEdit = $this->createForm(ArticleEditType::class, $article);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {

            $entityManager->flush();
            $this->addFlash('success', 'Article modifié avec succès');
            return $this->redirect($this->generateUrl('view_article', array('slug' => $article->getSlug())));

        }

        return $this->render(
            'Actualites/edit.html.twig',
            [
                'article' => $article,
                'formEdit' => $formEdit->createView(),
            ]
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/actualites/{slug}/imageEdit", name="imageEdit")
     */
    public function imageEditAction(Article $article, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        $formImageEdit = $this->createForm(ImageEditType::class, $article);
        $formImageEdit->handleRequest($request);

        if ($formImageEdit->isSubmitted() && $formImageEdit->isValid()) {

            if($article->getImage()){
                $file = $article->getImage();
                $fileName = $this->get('app.image_uploader')->upload($file);
                $article->setImage('uploads/images/' . $fileName);
            }

            $entityManager->flush();
            $this->addFlash('success', 'Image modifiée avec succès');
            return $this->redirect($this->generateUrl('view_article', array('slug' => $article->getSlug())));

        }

        return $this->render(
            'Actualites/imageEdit.html.twig',
            [
                'article' => $article,
                'formImageEdit' => $formImageEdit->createView(),
            ]
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/actualites/{slug}/imageDelete", name="imageDelete")
     */
    public function imageDeleteAction(Article $article, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        $article->setImage(null);
        $entityManager->flush();
        $this->addFlash('success', 'Image supprimée');
        return $this->redirect($this->generateUrl('view_article', array('slug' => $article->getSlug())));

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
