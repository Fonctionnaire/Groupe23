<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comment;

class AdminCommentController extends Controller
{

    /**
     * View all Comments
     * @Route("/admin/comments", name="adminComments")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewCommentsAction()
    {
        $listcomments = $this->getDoctrine()->getRepository("AppBundle:Comment")->findAll();
        return $this->render('Admin/comments.html.twig', array('listComments' => $listcomments,));
    }

    /**
     * Delete Comments
     * @Route("/admin/comment/{id}/delete", name="deleteComment")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteCommentAction(Comment $comment, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($comment);
        $entityManager->flush();
        $request->getSession()->getFlashbag()->add('success', 'Le commentaire a été Supprimé');
        return $this->redirect($referer);
    }

    /**
     * Unsignal
     * @Method({"GET"})
     * @Route("/admin/comment/{id}/unsignal", name="unsignalComment")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function unsignalCommentAction(Comment $comment, Request $request)
    {
        $referer = $request->headers->get('referer');
        $comment->setSignaled('0');
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        $request->getSession()->getFlashbag()->add('success', 'Le commentaire a été validé');
        return $this->redirect($referer);}


}