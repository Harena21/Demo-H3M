<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticlePersister implements DataPersisterInterface //postpersister doit implémenter le datapersisterInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function supports($data): bool
    {
        return $data instanceof Article ;
        //si true alors on peut exécuter persit et remove
    }
    public function persist($data)
    {
        $data->setCreatedAt(new \DateTime());
        $this->em->persist($data);
        $this->em->flush();
    }
    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
