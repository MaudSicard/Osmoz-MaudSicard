<?php

namespace App\DataFixtures\Provider;

class MovieDbProvider
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
      'Simplissime - Le livre de cuisine le + facile du monde : Simplissime',
      'Simplissime - : SIMPLISSIME Les recettes asiatiques les + faciles du monde',
      'Mortelle Adèle',
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

    /**
     * Return movie name
     */
    public function movieName()
    {
        return $this->movies[array_rand($this->movies)];
    }

    /**
     * Return book name
     */
    public function bookName()
    {
        return $this->books[array_rand($this->books)];
    }

    /**
     * Return music album name
     */
    public function musicName()
    {
        return $this->music[array_rand($this->music)];
    }

    /**
     * Return movie gender
     */
    public function movieGender()
    {
        return $this->movie_gender[array_rand($this->movie_gender)];
    }

    /**
     * Return book gender
     */
    public function bookGender()
    {
        return $this->book_gender[array_rand($this->book_gender)];
    }

    /**
     * Return movie gender
     */
    public function musicGender()
    {
        return $this->music_gender[array_rand($this->music_gender)];
    }
    /**
     * Return movie type
     */
    public function movieType()
    {
        return $this->movie_type[array_rand($this->movie_type)];
    }

    /**
     * Return book type
     */
    public function bookType ()
    {
        return $this->book_type[array_rand($this->book_type)];
    }

    /**
     * Return music type
     */
    public function musicType()
    {
        return $this->music_type[array_rand($this->music_type)];
    }
    
}
