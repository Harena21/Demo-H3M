<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    // private $em;
    // private $request;
    // public function __construct(EntityManagerInterface $em,Request $request)
    // {
    //     $this->em = $em;
    //     $this->request = $request;
    // }
    /**
     * @Route("/admin", name="admin_article")
     */
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();
        return $this->render('admin_article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    // /**
    //  * @Route("/admin/edit/{id}", name="admin_article_edit")
    //  */
    // public function edit(Article $article)
    // {
    //     $form = $this->createForm(ArticleType::class,$article);
    //     $form->handleRequest($this->request);

    //     if($form->isSubmitted() && $form->isValid()) 
    //     {
    //         $this->em->flush();
    //         return $this->redirectToRoute('admin_article');
    //     }
    //     return $this->render('admin_article/edit.html.twig',[
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
    * @Route("/admin/create",name="admin_article_create")
    * @Route("/admin/edit/{id}",name="admin_article_edit")
    */
    public function form(?Article $article,Request $request,EntityManagerInterface $manager)
    {
        if(!$article)
        {
            $article = new Article();
        }
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if(!$article->getId())
            {
                $article->setCreatedAt(new \DateTime());
                $this->addFlash('success',"Article créé avec succès");
            }
            else
            {
                $this->addFlash('success',"Article modifié avec succès");
            }
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute("admin_article");
        }
        return $this->render('admin_article/form.html.twig',[
            'form' => $form->createView(),
            'article' => $article,
            'editForm' => $article->getId() !== null
        ]);    
    }
    /**
     * @Route("admin/delete/{id}", name="admin_article_delete",methods="DELETE")
     */
    public function delete(Article $article,Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $article->getId(),$request->get('_token')))
        {
            // $this->em->remove($article);
            // $this->em->flush();
            // $this->addFlash('success',"Article supprimé avec succès");

            return new Response("Suppression");

        }
    }
    /**
     * @Route("admin/comment",name="admin_comment_show")
     */
    public function showComment(CommentRepository $repo)
    {
        $comments = $repo->findAll();

        return $this->render('admin_article/comment.html.twig',[
            'comments' => $comments
        ]);
    }
    /**
     * @Route("admin/comment/{id}",name="admin_comment_moderate")
     */
    public function validComment($id,CommentRepository $repo,Request $request,EntityManagerInterface $manager)
    {
        $comment = $repo->find($id);
        // dd($request->request->get('mode'));

        if($request->request->get('mode') === 'true')
        {
            $comment->setMode(true);
        }
        else
        {
            $comment->setMode(false);
        }
        $manager->persist($comment);
        $manager->flush();

         return $this->redirectToRoute('admin_comment_show');
    }

}
