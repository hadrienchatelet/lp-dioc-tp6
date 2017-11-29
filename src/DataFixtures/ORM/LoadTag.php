<?php
/**
 * Created by PhpStorm.
 * User: hadrien.chatelet
 * Date: 29/11/17
 * Time: 08:27
 */

namespace App\DataFixtures\ORM;


use App\Entity\Tag;
use App\Slug\SlugGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTag extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $slug = $this->container->get(SlugGenerator::class);
        $tags = [
            new Tag('News', $slug->generate('News')),
            new Tag('Food', $slug->generate('Food')),
            new Tag('Sport',$slug->generate('Sport'))
        ];

        foreach ($tags as $tag)
            $manager->persist($tag);
        $manager->flush();
    }
}