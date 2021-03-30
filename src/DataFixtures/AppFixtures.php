<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Book;
use App\Entity\Mail;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Movie;
use App\Entity\Music;
use App\Entity\Gender;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\OsmozProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
     // Password encoder
     private $passwordEncoder;

     private $connection;

     /**
      * On injecte les dépendances (les objets utiles au fonctionnement de nos Fixtures) dans le constructeur car AppFixtures est elle aussi un service
      */
     public function __construct(UserPasswordEncoderInterface $passwordEncoder, Connection $connection)
     {
         $this->passwordEncoder = $passwordEncoder;
         $this->connection = $connection;
     }
     
    const NB_BOOK = 20;
    const NB_MOVIE = 31;
    const NB_MUSIC = 10;
    const NB_BOOK_TYPE = 11;
    const NB_BOOK_GENDER = 21;
    const NB_MOVIE_TYPE = 3;
    const NB_MOVIE_GENDER = 15;
    const NB_MUSIC_TYPE = 2;
    const NB_MUSIC_GENDER = 14;
    const NB_MAIL = 10;

    private function truncate()
    {
        $users = $this->connection->query('SET foreign_key_checks = 0');

        $users = $this->connection->query('TRUNCATE TABLE movie');
        $users = $this->connection->query('TRUNCATE TABLE movie_gender');
        $users = $this->connection->query('TRUNCATE TABLE book');
        $users = $this->connection->query('TRUNCATE TABLE book_gender');
        $users = $this->connection->query('TRUNCATE TABLE music');
        $users = $this->connection->query('TRUNCATE TABLE music_gender');
        $users = $this->connection->query('TRUNCATE TABLE gender');
        $users = $this->connection->query('TRUNCATE TABLE type');
        $users = $this->connection->query('TRUNCATE TABLE user');
        $users = $this->connection->query('TRUNCATE TABLE user_mail');
        $users = $this->connection->query('TRUNCATE TABLE mail');

    }


    public function load(ObjectManager $manager)
    {
        $this->truncate();
        
        $faker = Faker\Factory::create('fr_FR');

        $faker->addProvider(new OsmozProvider());

        $bookTypeList = [];
        $movieTypeList = [];
        $musicTypeList = [];
        $bookGenderList = [];
        $movieGenderList = [];
        $musicGenderList = [];
        $userList = [];

        $userChloe = new User();
        $userChloe->setEmail('chloe@chloe.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($userChloe, 'chloe');
        $userChloe->setPassword($encodedPassword);
        $userChloe->setRoles(['ROLE_ADMIN']);
        $userChloe->setNickname('Chloé');
        $userChloe->setCreatedAt(new \DateTime());
        $userList[] = $userChloe;
        $manager->persist($userChloe);

        $userCharlotte = new User();
        $userCharlotte->setEmail('charlotte@charlotte.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($userCharlotte, 'charlotte');
        $userCharlotte->setPassword($encodedPassword);
        $userCharlotte->setRoles(['ROLE_ADMIN']);
        $userCharlotte->setNickname('Charlotte');
        $userCharlotte->setCreatedAt(new \DateTime());
        $userList[] = $userCharlotte;
        $manager->persist($userCharlotte);

        $userClem = new User();
        $userClem->setEmail('clem@clem.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($userClem, 'clem');
        $userClem->setPassword($encodedPassword);
        $userClem->setRoles(['ROLE_ADMIN']);
        $userClem->setNickname('Clem');
        $userClem->setCreatedAt(new \DateTime());
        $userList[] = $userClem;
        $manager->persist($userClem);

        $userMicka = new User();
        $userMicka->setEmail('micka@micka.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($userMicka, 'micka');
        $userMicka->setPassword($encodedPassword);
        $userMicka->setRoles(['ROLE_ADMIN']);
        $userMicka->setNickname('Micka');
        $userMicka->setCreatedAt(new \DateTime());
        $userList[] = $userMicka;
        $manager->persist($userMicka);

        $userMaud = new User();
        $userMaud->setEmail('maud@maud.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($userMaud, 'maud');
        $userMaud->setPassword($encodedPassword);
        $userMaud->setRoles(['ROLE_ADMIN']);
        $userMaud->setNickname('Maud');
        $userMaud->setCreatedAt(new \DateTime());
        $userList[] = $userMaud;
        $manager->persist($userMaud);



        for ($i = 0; $i < self::NB_BOOK_TYPE; $i++) {
            $type = new Type();
            $type->setName($faker->bookType($i));
            $type->setMedia(["book"]);
            $type->setCreatedAt(new \DateTime());
            
            $bookTypeList[] = $type;
            
            $manager->persist($type);
        }

        for ($i = 0; $i < self::NB_MOVIE_TYPE; $i++) {
            $type = new Type();
            $type->setName($faker->movieType($i));
            $type->setMedia(["movie"]);
            $type->setCreatedAt(new \DateTime());

            $movieTypeList[] = $type;

            $manager->persist($type);
        }

        for ($i = 0; $i < self::NB_MUSIC_TYPE; $i++) {
            $type = new Type();
            $type->setName($faker->musicType($i));
            $type->setMedia(["music"]);
            $type->setCreatedAt(new \DateTime());

            $musicTypeList[] = $type;

            $manager->persist($type);
        }

        for ($i = 0; $i < self::NB_BOOK_GENDER; $i++) {
            $gender = new Gender();
            $gender->setName($faker->bookgender($i));
            $gender->setMedia(["book"]);
            $gender->setCreatedAt(new \DateTime());

            $bookGenderList[] = $gender;

            $manager->persist($gender);
        }

        for ($i = 0; $i < self::NB_MOVIE_GENDER; $i++) {
            $gender = new Gender();
            $gender->setName($faker->movieGender($i));
            $gender->setMedia(["movie"]);
            $gender->setCreatedAt(new \DateTime());

            $movieGenderList[] = $gender;

            $manager->persist($gender);
        }

        for ($i = 0; $i < self::NB_MUSIC_GENDER; $i++) {
            $gender = new Gender();
            $gender->setName($faker->musicGender($i));
            $gender->setMedia(["music"]);
            $gender->setCreatedAt(new \DateTime());

            $musicGenderList[] = $gender;

            $manager->persist($gender);
        }

        for ($i = 0; $i < self::NB_BOOK; $i++) {
            $book = new Book();
            $book->setName($faker->bookName($i));
            $book->setAuthor($faker->bookAuthor($i));
            $book->setState($faker->state());
            $book->setStatus($faker->status());
            $book->setCreatedAt(new \DateTime());

            $bookType = $bookTypeList[array_rand($bookTypeList)];
            $book->setType($bookType);

            shuffle($bookGenderList);

            for ($r = 0; $r < mt_rand(1, 2); $r++) {
            $bookGender = $bookGenderList[array_rand($bookGenderList)];
            $book->addGender($bookGender);
            }

            $user = $userList[array_rand($userList)];
            $book->setUser($user);

            $manager->persist($book);
        }


        for ($i = 0; $i < self::NB_MUSIC; $i++) {
            $music = new Music();
            $music->setName($faker->musicName($i));
            $music->setArtist($faker->musicArtist($i));
            $music->setState($faker->state());
            $music->setStatus($faker->status());
            $music->setCreatedAt(new \DateTime());
            $music->setSupport($faker->musicSupport());

            $musicType = $musicTypeList[array_rand($musicTypeList)];
            $music->setType($musicType);

            shuffle($musicGenderList);

            for ($r = 0; $r < mt_rand(1, 2); $r++) {
            $musicGender = $musicGenderList[array_rand($musicGenderList)];
            $music->addGender($musicGender);
            }

            $user = $userList[array_rand($userList)];
            $music->setUser($user);

            $manager->persist($music);
        }


        for ($i = 0; $i < self::NB_MOVIE; $i++) {
            $movie = new Movie();
            $movie->setName($faker->movieName($i));
            $movie->setState($faker->state());
            $movie->setStatus($faker->status());
            $movie->setCreatedAt(new \DateTime());
            $movie->setSupport($faker->movieSupport());

            $movieType = $movieTypeList[array_rand($movieTypeList)];
            $movie->setType($movieType);

            shuffle($musicGenderList);

            for ($r = 0; $r < mt_rand(1, 2); $r++) {
            $movieGender = $movieGenderList[array_rand($movieGenderList)];
            $movie->addGender($movieGender);
            }

            $user = $userList[array_rand($userList)];
            $movie->setUser($user);

            $manager->persist($movie);
        }
       
        for ($i = 0; $i < self::NB_MAIL; $i++) {
            $mail = new Mail();
            $mail->setContent($faker->unique->paragraph());
            $mail->setCreatedAt(new \DateTime());

            shuffle($userList);

            for ($r = 0; $r < mt_rand(1, 2); $r++) {
            $user = $userList[array_rand($userList)];
            $mail->addUser($user);
            }

            $manager->persist($mail);
        }


        $manager->flush();
    }
}