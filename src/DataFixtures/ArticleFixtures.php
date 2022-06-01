<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
Use Faker\Factory;

class ArticleFixtures extends Fixture
{
    // public function load(ObjectManager $manager): void
    // {
    //     // $product = new Product();
    //     // $manager->persist($product);
    //     $faker = Factory::create('fr-FR');
    //     for($i=0; $i<10; $i++)
    //     {
    //         $article = new Article();
    //         $article
    //             ->setTitle($faker->words(3,true))
    //             ->setContent('<p>' . $faker->sentences(4,true) . '</p>')
    //             ->setImage("http://placehold.it/150")
    //             ->setCreatedAt(new \DateTime($datetime='now'));
    //         $manager->persist($article);
    //     }

    //     $manager->flush();
    // }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr-FR');
        //Création de 3 catégories
        for($i=0; $i<3; $i++)
        {
            $category = new Category();
            $category->setTitle($faker->sentence());
            $category->setDescription($faker->paragraph());

            $manager->persist($category);
            //création de 4à6 articles
            
            for($j=0; $j<mt_rand(4,6); $j++)
            {
                $article = new Article();

                $content = '<p>' . implode('</p><p>',$faker->paragraphs(3)) . '</p>';
               
                $article
                    ->setTitle($faker->words(3,true))
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-1 year'))
                    ->setCategory($category);

                for($k=0; $k<mt_rand(0,10); $k++)
                {
                    $comment = new Comment();

                    $content = '<p>' . implode('</p><p>',$faker->paragraphs(2)) . '</p>';

                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;
                    $comment
                        ->setAuthor($faker->name)
                        ->setContent($content)
                        ->setCreatedAt( $faker->dateTimeBetween('-' . $days .'days'))
                        ->setArticle($article)
                        ->setMode(false);
                    $manager->persist($comment);
                }
                $manager->persist($article);
            }
        }
        $manager->flush();
    }


    // // public function load(ObjectManager $manager): void
    // // {
    // //     // $product = new Product();
    // //     // $manager->persist($product);
    // //     $faker = Factory::create('fr-FR');
    // //     for($i=0; $i<10; $i++)
    // //     {
    // //         $article = new Article();
    // //         $article
    // //             ->setTitle($faker->words(3,true))
    // //             ->setContent('<p>' . $faker->sentences(4,true) . '</p>')
    // //             ->setImage("http://placehold.it/150")
    // //             ->setCreatedAt(new \DateTime($datetime='now'));
    // //         $manager->persist($article);
    // //     }

    // //     $manager->flush();
    // // }
    // public function load(ObjectManager $manager): void
    // {
    //     // $product = new Product();
    //     // $manager->persist($product);
    //     $faker = Factory::create('fr-FR');
    //     //Création de 3 catégories
    //     for($i=0; $i<3; $i++)
    //     {
    //         $category = new Category();
    //         $category->setTitle($faker->sentence());
    //         $category->setDescription($faker->paragraph());

    //         $manager->persist($category);
    //         //création de 4à6 articles
            
    //         for($j=0; $j<mt_rand(4,6); $j++)
    //         {
    //             $article = new Article();

    //             $content = '<p>' . implode('</p><p>',$faker->paragraphs(3)) . '</p>';
               
    //             $article
    //                 ->setTitle($faker->words(3,true))
    //                 ->setContent($content)
    //                 ->setImage($faker->imageUrl())
    //                 ->setCreatedAt($faker->dateTimeBetween('-1 year'))
    //                 ->setCategory($category);

    //             for($k=0; $k<mt_rand(0,10); $k++)
    //             {
    //                 $comment = new Comment();

    //                 $content = '<p>' . implode('</p><p>',$faker->paragraphs(2)) . '</p>';

    //                 $days = (new \DateTime())->diff($article->getCreatedAt())->days;
    //                 $comment
    //                     ->setAuthor($faker->name)
    //                     ->setContent($content)
    //                     ->setCreatedAt( $faker->dateTimeBetween('-' . $days .'days'))
    //                     ->setArticle($article);
    //                 $manager->persist($comment);
    //             }
    //             $manager->persist($article);
    //         }
    //     }
    //     $manager->flush();
    // }
}
