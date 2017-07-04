<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comment;
use AppBundle\Form\Type\CommentType;
use AppBundle\Entity\Article;

class CommentController extends Controller
{
    /**
     * Display form to add a NEW comment
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     * @Route("/actualites/{slug}/comments/add", name="addComment")
     *
     */
    public function addCommentAction(Article $article, Request $request)
    {
        if ($article->getEnableComments() === false) {
            return $this->redirectToRoute('view_article', array('slug' => $article->getSlug()));

        }
        $comment = new Comment();
        $comment->setArticle($article)->setAuthor($this->get('security.token_storage')->getToken()->getUser());
        $form = $this->createForm(CommentType::class, $comment, array(
            'action' => $this->generateUrl('addComment', array(
                'slug' => $article->getSlug()))));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checkAntispam = $this->get('app.antispam')->isSpam($comment->getContent());
            if ($checkAntispam['spam']) {
                $request->getSession()->getFlashbag()->add('danger', $checkAntispam['message']);
                return $this->redirectToRoute('view_article', array(
                    'slug' => $article->getSlug()));
            }

            $comment->setContent($checkAntispam['content']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $request->getSession()->getFlashbag()->add('success', 'Le commentaire a bien été enregistré');

            return $this->redirectToRoute('view_article', array('slug' => $article->getSlug()));

        }
        return $this->render('Actualites/commentForm.html.twig', [
                'article' => $article,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Display Form to reply to a comment
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     * @Route("/actualites/{slug}/comment/{id}/reply", name="replyComment")
     */
    public function replyCommentAction(Comment $parent, Request $request)
    {
        $comment = new Comment();
        $comment
            ->setLevel($parent->getLevel()+ 1)
            ->setArticle($parent->getArticle())
            ->setParent($parent)
            ->setAuthor($this
                ->get('security.token_storage')
                ->getToken()->getUser());



        $form = $this->createForm(CommentType::class, $comment, array(
            'action' => $this->generateUrl('replyComment', array(
                'slug' => $comment->getArticle()->getSlug(),
                'id' => $parent->getId()))));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checkAntispam = $this->get('app.antispam')->isSpam($comment->getContent());
            if ($checkAntispam['spam']) {
                $request->getSession()->getFlashbag()->add('danger', $checkAntispam['message']);
                return $this->redirectToRoute('view_article', array('slug' => $comment->getArticle()->getSlug()));

            } else {

                $comment->setContent($checkAntispam['content']);
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();
                $request->getSession()->getFlashbag()->add('success', 'Le commentaire a bien été enregistré');
                return $this->redirectToRoute('view_article', array('slug' => $comment->getArticle()->getSlug()));
            }
        }
        return $this->render('Actualites/commentReplyForm.html.twig', [
                'article' => $comment->getArticle(),
                'comment' => $comment,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * Signal a Admin
     * @Method({"GET"})
     * @Route("actualites/{slug}/comment/{id}/signal", name="signalComment")
     * @Security("has_role('ROLE_USER')")
     */
    public function signalCommentAction(Comment $comment, Request $request)
    {
        $nbSignaled = $comment->getSignaled();
        $nbSignaled++;
        $comment->setSignaled($nbSignaled);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $request->getSession()->getFlashbag()->add('success', 'Le commentaire a bien été signalé');
        return $this->redirectToRoute('view_article', array('slug' => $comment->getArticle()->getSlug()));
    }
}
