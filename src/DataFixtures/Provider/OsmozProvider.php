<?php

namespace App\DataFixtures\Provider;

class OsmozProvider
{
    private $movies = [
      'Fright Night 2',
      'Dracula Untold',
      '30 jours de nuit',
      'Only lovers left alive',
      'Blade',
      'Blade 2',
      'Blade: Trinity',
      'À l\'aube du sixième jour',
      'Battlefield Earth',
      'Hollow Man',
      'Planète rouge',
      'X-Men',
      'The Internet\'s Own Boy : The Story of Aaron Swartz',
      'La Commune (Paris 1871)',
      'Le monde selon Monsento',
      'Game of Thrones',
      'Rome',
      'The walking dead',
      'The Paradise',
      'Me and Mrs Jones',
      'Space2063',
      'House of cards',
      'Batman The Dark Knight',
      'Edward aux mains d\'argent',
      'Le majordome',
      'Avengers',
      'Breaking bad',
      'Mad Men',
      'Pretty Little Liars',
      'Downton Abbey',
      'Charmed',
    ];

    private $books = [
      'L\'astrologie Miroir',
      'La Chronique des Bridgerton - 1 & 2',
      'Orgueil et Préjugés',
      'One Piece - Tome 1',
      'La Voie du Paganisme',
      'Réussir son référencement Web',
      'P\'tit loup sauve la planète',
      'Miracle Morning',
      'Les écureuils de Central Park sont tristes le lundi',
      'La couleur des émotions',
      'L\'alimentation fitnext',
      'L\'anglais au bureau',
      'Ange et Démon',
      'Origine',
      'Ce que savait la nuit',
      'La valse du diable',
      'Double miroir',
      'Simplissime Le livre de cuisine le + facile du monde ',
      'Simplissime Les recettes asiatiques les plus faciles du monde',
      'Mortelle Adèle',
    ];

    private $author_book = [
      'Marie Sélène',
      'Julia Quinn',
      'Jane Austen',
      'Eiichiro Oda',
      'John Beckett',
      'Olivier Andrieu',
      'Eleone Thuillier',
      'Hal Elrod',
      'Katerine Pancol',
      'Anna Llenas',
      'Erwann Menthéour',
      'Haraps',
      'Dan Brown',
      'Dan Brown',
      'Arnaldur Indridason',
      'Jonathan Kellerman',
      'Jonathan Kellerman',
      'Jean-François Mallet',
      'Jean-François Mallet',
      'Mr Tan',
    ];

    private $music = [
      'Yours truly, angry mob',
      'Reasonable Doubt',
      '1999',
      'Mesdames',
      'Stadium Arcadium',
      'Tandem',
      'Dans la peau',
      'The Drug in me is You',
      'American Beauty/American Psycho',
      'Dark & Wild',
    ];

    private $artist_music = [
      'Kaiser Chiefs',
      'Jay-Z',
      'Cassius',
      'Grand Corps Malade',
      'Red Hot Chili Pepers',
      'Madame Monsieur',
      'Kyo',
      'Falling in Reverse',
      'Fall Out Boy',
      'BTS',
    ];
  
    private $book_gender = [
      'Historique',
      'Romance',
      'Aventure',
      'Polar',
      'Esotérisme',
      'Autobiographique',
      'Drame',
      'Fantastique',
      'Science Fiction',
      'Fantasy',
      'Action',
      'Horreur',
      'Psychologie',
      'Drame',
      'Cuisine',
      'Langues',
      'Jardinage',
      'Informatique',
      'Technologie',
      'Fiction',
      'Educatif',
    ];

    private $movie_gender = [
      'Drame',
      'Action',
      'Aventure',
      'Comédie',
      'Policier / Crime',
      'Fantastique',
      'Fantasy',
      'Horreur/Epouvante',
      'Musical',
      'Romance',
      'Science-Fiction',
      'Super-Héros',
      'Survival',
      'Thriller',
      'Historique',
    ];

    private $music_gender = [
      'Pop',
      'Rock',
      'Dance/Electro/House',
      'Bande Son (OST)',
      'Hip-Hop',
      'Variétés',
      'Classique/Opéra',
      'R&B',
      'Soul/Blues',
      'Metal',
      'K-POP/J-POP',
      'Pop/Rock',
      'Rap',
      'Slam',
    ];

    private $book_type = [
      'Romans',
      'Bandes Dessinées/Comics',
      'Mangas',
      'Magazines',
      'Jeunesse',
      'Apprentisage',
      'Art, Cuture, Société',
      'Scolaire',
      'Nature & Loisirs',
      'Vie Pratique',
      'Encyclopedies/Dictionnaires',
    ];

    private $movie_type = [
      'Séries',
      'Films',
      'Documentaires',
    ];

    private $music_type = [
      'CD', 
      'Vinyle'
    ];

    private $status = [
      'dispo',
      'pas dispo',
      'réservé'
    ];

    private $state = [
      1 ,
      2 ,
      3
    ];

    private $user = [
      'chloe@chloe.com',
      'charlotte@charlotte.com',
      'clem@clem.com',
      'micka@micka.com',
      'maud@maud.com'
    ];

    private $support_music = [
      'cd',
      'vinyle'
    ];

    private $support_movie = [
      'dvd',
      'blue-ray'
    ];

    /**
     * Return a user
     */
    public function user()
    {
        return $this->user[array_rand($this->user)];
    }

    /**
     * Return a status
     */
    public function status()
    {
        return $this->status[array_rand($this->status)];
    }

    /**
     * Return a state
     */
    public function state()
    {
        return $this->state[array_rand($this->state)];
    }

     /**
     * Return a music support
     */
    public function musicSupport()
    {
        return $this->support_music[array_rand($this->support_music)];
    }

     /**
     * Return a movie support
     */
    public function movieSupport()
    {
        return $this->support_movie[array_rand($this->support_movie)];
    }

    /**
     * Return movie name
     */
    public function movieName($i)
    {
        return $this->movies[$i];
    }

    /**
     * Return book name
     */
    public function bookName($i)
    {
        return $this->books[$i];
    }

       /**
     * Return book author
     */
    public function bookAuthor($i)
    {
        return $this->author_book[$i];
    }

    /**
     * Return music album name
     */
    public function musicName($i)
    {
        return $this->music[$i];
    }

       /**
     * Return music artist
     */
    public function musicArtist($i)
    {
        return $this->artist_music[$i];
    }

    /**
     * Return movie gender
     */
    public function movieGender($i)
    {
        return $this->movie_gender[$i];
    }

    /**
     * Return book gender
     */
    public function bookGender($i)
    {
        return $this->book_gender[$i];
    }

    /**
     * Return movie gender
     */
    public function musicGender($i)
    {
        return $this->music_gender[$i];
    }
    /**
     * Return movie type
     */
    public function movieType($i)
    {
        return $this->movie_type[$i];
    }

    /**
     * Return book type
     */
    public function bookType($i)
    {
        return $this->book_type[$i];
    }

    /**
     * Return music type
     */
    public function musicType($i)
    {
        return $this->music_type[$i];
    }
    
}
