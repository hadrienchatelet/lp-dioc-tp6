<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    private $slug;
    private $token;

    public function __construct(SlugGenerator $slug, TokenStorage $token)
    {
        $this->slug = $slug;
        $this->token = $token;
    }


    public function handle(Article $article): void
    {
        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
        $article->setSlug($this->slug->generate($article->getTitle()));
        $article->setAuthor($this->token->getToken()->getUser());
    }
}
