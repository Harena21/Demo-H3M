<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
// use App\Entity\Comment;
// use App\Form\ArticleType;
// use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/",name="home")
     *
     * @return Response
     */
    public function home(): Response
    {
        // return $this->render('blog/home.html.twig', [
        //     'controller_name' => 'BlogController',
        // ]);
        return $this->render('blog/home.html.twig');
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();
        // dd($articles);
        return $this->render('blog/index.html.twig', [
            'articles' => $articles
        ]);
    }
    
    /** 
     * @Route("/blog/{id}",name="blog_show")
     *
     * @return Response
     */
    public function show(Article $article,Request $request,EntityManagerInterface $manager,CommentRepository $repo): Response
    {
        $comment = new Comment();
        // $comments = 
        $form = $this->createForm(CommentType::class,$comment);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $comment
                ->setCreatedAt(new \DateTime())
                ->setArticle($article);

            $manager->persist($comment);
            $manager->flush();
        }
        $article_comments = $repo->findComment($article,true);

        $article2 = new Article();
        foreach($article_comments as $comment)
        {
            $article2->addComment($comment);
        }
        dd($article2);
        // $article2->

        return $this->render('blog/show.html.twig',[
            'article' => $article,
            'article_true' => $article2,
            'commentForm' => $form->createView()
        ]);
    }

// /**
    //  * @Route("/blog/{id}",name="blog_show")
    //  *
    //  * @return Response
    //  */
    // public function show(Article $article): Response
    // {
    //     return $this->render('blog/show.html.twig',[
    //         'article' => $article
    //     ]);
    // }


    // /**
    //  * @Route("/blog", name="blog")
    //  */
    // public function index(ArticleRepository $repo): Response
    // {
    //     $articles = $repo->findAll();
    //     return $this->render('blog/index.html.twig', [
    //         'articles' => $articles
    //     ]);
    // }
    // /**
    //  * @Route("/",name="home")
    //  *
    //  * @return Response
    //  */
    // public function home(): Response
    // {
    //     // return $this->render('blog/home.html.twig', [
    //     //     'controller_name' => 'BlogController',
    //     // ]);
    //     return $this->render('blog/home.html.twig');
    // }

    // /**
    //  * @Route("/blog/create",name="blog_create")
    //  * @Route("/blog/edit/{id}",name="blog_edit",requirements={"id":"\d+"})
    //  */
    // public function form(?Article $article,Request $request,EntityManagerInterface $manager)
    // {
    //     if(!$article)
    //     {
    //         $article = new Article();
    //     }
    //     $form = $this->createForm(ArticleType::class,$article);
    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         if(!$article->getId())
    //         {
    //             $article->setCreatedAt(new \DateTime());
    //         }
    //         $manager->persist($article);
    //         $manager->flush();

    //         return $this->redirectToRoute("blog_show",[
    //             'id' => $article->getId() ]);
    //     }
    //     return $this->render('blog/form.html.twig',[
    //         'form' => $form->createView(),
    //         'article' => $article,
    //         'editForm' => $article->getId() !== null
    //     ]);    
    // }
        
    ///**
     //* @Route("/blog/{id}",name="blog_show")
     //*
     //* @return Response
    //  */
    // public function show(Article $article,Request $request,EntityManagerInterface $manager): Response
    // {
    //     $comment = new Comment();
    //     $form = $this->createForm(CommentType::class,$comment);

    //     $form->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $comment
    //             ->setCreatedAt(new \DateTime())
    //             ->setArticle($article);

    //         $manager->persist($comment);
    //         $manager->flush();
    //     }
    //     return $this->render('blog/show.html.twig',[
    //         'article' => $article,
    //         'commentForm' => $form->createView()
    //     ]);
    // }

}
    