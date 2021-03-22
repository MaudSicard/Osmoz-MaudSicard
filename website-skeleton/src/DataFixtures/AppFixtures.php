<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Book;
use App\Entity\Movie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\OsmozProvider;

class AppFixtures extends Fixture
{
    const NB_BOOK = 20;
    const NB_MOVIE = 31;
    const NB_MUSIC = 10;
    const NB_BOOK_TYPE = 11;
    const NB_BOOK_GENDER = 21;
    const NB_MOVIE_TYPE = 3;
    const NB_MOVIE_GENDER = 15;
    const NB_MUSIC_TYPE = 2;
    const NB_MUSIC_GENDER = 14;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $faker->addProvider(new OsmozProvider());

        for ($i = 1; $i < self::NB_BOOK; $i++) {
            $book = new Book();
            $book->setName($faker->bookName());
            $book->setAuthor($faker->bookAuthor());
            $book->setStatus(1);
            $book->setState(1);
            $book->setCreatedAt(new \DateTime());
            $manager->persist($book);
        }
        $manager->flush();
    }
}
