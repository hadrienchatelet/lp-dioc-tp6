<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;

class UpdateArticleHandler
{
    private $slug;

    public function __construct(SlugGenerator $slug)
    {
        $this->slug = $slug;
    }

    public function handle(Article $article)
    {
        // Slugify le titre et met à jour la date de mise à jour de l'article
        // Log également un article stat avec pour action update.
        $article->setSlug($this->slug->generate($article->getTitle()));
        $article->setUpdatedAt(new \DateTime());
    }
}
