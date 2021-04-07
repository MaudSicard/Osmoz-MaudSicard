<?php

namespace App\Service;

class Localisation
{
  public function truncate($zipcode)
  {
   
    if(str_starts_with($zipcode, '0')) {
      $departement = "0" . substr(strval($zipcode), 1, 1 );
      return $departement;
    }
    $departementString = substr(strval($zipcode), 0, 2 );
    $departement = intval($departementString);

    return $departement;
  }

}