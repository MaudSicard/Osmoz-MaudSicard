<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Book;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Movie;
use App\Entity\Gender;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\OsmozProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
     // Password encoder
     private $passwordEncoder;

     /**
      * On injecte les dépendances (les objets utiles au fonctionnement de nos Fixtures) dans le constructeur car AppFixtures est elle aussi un service
      */
     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
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

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $faker->addProvider(new OsmozProvider());

        $bookTypeList = [];
        $movieTypeList = [];
        $musicTypeList = [];
        $bookGenderList = [];
        $movieGenderList = [];
        $musicGenderList = [];
        $userList = [];

        $user = new User();
        $user->setEmail('admin@admin.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'admin');
        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCreatedAt(new \DateTime());
        $userList[] = $user;
        $manager->persist($user);

        $userChloe = new User();
        $userChloe->setEmail('chloe@chloe.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'chloe');
        $userChloe->setPassword($encodedPassword);
        $userChloe->setRoles(['ROLE_ADMIN']);
        $userChloe->setCreatedAt(new \DateTime());
        $userList[] = $userChloe;
        $manager->persist($userChloe);

        $userCharlotte = new User();
        $userCharlotte->setEmail('charlotte@charlotte.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'charlotte');
        $userCharlotte->setPassword($encodedPassword);
        $userCharlotte->setRoles(['ROLE_ADMIN']);
        $userCharlotte->setCreatedAt(new \DateTime());
        $userList[] = $userCharlotte;
        $manager->persist($userCharlotte);

        $userClem = new User();
        $userClem->setEmail('clem@clem.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'clem');
        $userClem->setPassword($encodedPassword);
        $userClem->setRoles(['ROLE_ADMIN']);
        $userClem->setCreatedAt(new \DateTime());
        $userList[] = $userClem;
        $manager->persist($userClem);

        $userMicka = new User();
        $userMicka->setEmail('micka@micka.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'micka');
        $userMicka->setPassword($encodedPassword);
        $userMicka->setRoles(['ROLE_ADMIN']);
        $userMicka->setCreatedAt(new \DateTime());
        $userList[] = $userMicka;
        $manager->persist($userMicka);

        $userMaud = new User();
        $userMaud->setEmail('maud@maud.com');
        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'maud');
        $userMaud->setPassword($encodedPassword);
        $userMaud->setRoles(['ROLE_ADMIN']);
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

            $bookGender = $bookGenderList[array_rand($bookGenderList)];
            $book->addGender($bookGender);

            $user = $userList[array_rand($userList)];
            $book->setUser($user);

            $manager->persist($book);
        }

       

        $manager->flush();
    }
}
