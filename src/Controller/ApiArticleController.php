<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiArticleController extends AbstractController
{
    /**
     * @Route("/apip/article", name="api_article")
     */
    public function index(ArticleRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll(),200,[],['groups' => 'Post:read']);
        // return $this->render('api_article/index.html.twig', [
        //     'controller_name' => 'ApiArticleController',
        // ]);
    }
}
