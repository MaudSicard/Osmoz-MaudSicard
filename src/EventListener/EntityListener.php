<?php

namespace App\EventListener;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Movie;
use App\Entity\Music;
use App\Service\MySlugger;
use App\Service\Localisation;

use Doctrine\Persistence\Event\LifecycleEventArgs;

/**
 * Cet écouteur va être appelé selon la configuration de services.yaml
 * ici avant chaque persist() et update()
 * 
 * On remplace l'appel au Slugger présent dans Fixtures, Movie Add et Move Edit
 * par cet écouteur unique
 */
class EntityListener
{
    private $mySlugger;
    private $localisation;


    public function __construct(MySlugger $mySlugger, Localisation $localisation)
    {
        $this->mySlugger = $mySlugger;
        $this->localisation = $localisation;

    }

    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function updateSlugMovie(Movie $movie, LifecycleEventArgs $event): void
    {
        // Slugifie le film
        $slug = $this->mySlugger->slugify($movie->getName());
        $movie->setSlug($slug);
    }

    public function updateSlugBook(Book $book, LifecycleEventArgs $event): void
    {
        // Slugifie le film
        $slug = $this->mySlugger->slugify($book->getName());
        $book->setSlug($slug);
    }

    public function updateSlugMusic(Music $music, LifecycleEventArgs $event): void
    {
        // Slugifie le film
        $slug = $this->mySlugger->slugify($music->getName());
        $music->setSlug($slug);
    }

    public function updateDepartementUser(User $user)
    {
        $departement = $this->localisation->truncate($user->getZipcode());
        $user->setDepartement($departement);
    }

}