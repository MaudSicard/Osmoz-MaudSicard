<?php

namespace App\Service;

class Localisation
{
  public function truncate($zipcode)
  {
    
    $departementString = substr(strval($zipcode), 0, 2 );
    $departement = intval($departementString);

    return $departement;
  }

}