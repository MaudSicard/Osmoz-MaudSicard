<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger
{
    /**
     * @var SluggerInterface $slugger le slugger de Symfony 
     * */
    private $slugger;

    /**
     * @var bool $toLower Paramètre de la configuration pour passer en minuscule
     */
    private $toLower;

    public function __construct(SluggerInterface $slugger, bool $toLower)
    {
        $this->slugger = $slugger;
        $this->toLower = $toLower;
    }

    public function slugify(string $string)
    {
        // on slugifie
        $slug = $this->slugger->slug($string);

        // on lower ou pas ?
        if($this->toLower) {
            return $slug->lower();
        }

        return $slug;

    }

    /**
     * Get $toLower Paramètre de la configuration pour passer en minuscule
     *
     * @return  bool
     */ 
    public function getToLower()
    {
        return $this->toLower;
    }

    /**
     * Set $toLower Paramètre de la configuration pour passer en minuscule
     *
     * @param  bool  $toLower  $toLower Paramètre de la configuration pour passer en minuscule
     *
     * @return  self
     */ 
    public function setToLower(bool $toLower)
    {
        $this->toLower = $toLower;

        return $this;
    }
}