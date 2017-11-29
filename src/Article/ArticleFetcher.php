<?php

namespace App\Article;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ArticleFetcher
{
    private $registry;
    private $limit;

    public function __construct(Registry $registry, $limit)
    {
        $this->registry = $registry;
        $this->limit = $limit;
    }


    public function fetch() : array
    {
        // Retourne les 10 derniers articles.
        // La limit (ici 10) doit provenir d'une variable d'env.
        $repository = $this->registry->getRepository(Article::class);
        $article = $repository->findBy(array(), array('updatedAt' => 'DESC'), $this->limit);

        return $article;
    }
}
