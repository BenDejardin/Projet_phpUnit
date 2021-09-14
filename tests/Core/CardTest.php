<?php

namespace App\Tests\Core; // l'endroit ou se trouve la classe

use App\Core\CardGame32;
use PHPUnit\Framework\TestCase;
use App\Core\Card;

class CardTest extends TestCase
{

  public function testName()
  {
    $card = new Card('As', 'Trefle');
    $this->assertEquals('As', $card->getName());
    $card = new Card('2', 'Trefle');
    $this->assertEquals('2', $card->getName());

  }

  public function testColor()
  {
    $card = new Card('As', 'Trefle');
    $this->assertEquals('Trefle', $card->getColor());
    $card = new Card('As', 'Pique');
    $this->assertEquals('Pique', $card->getColor());
  }

  public function testCompareSameCard()
  {
    $card1 = new Card('As', 'Trefle');
    $card2 = new Card('As', 'Trefle');
    $this->assertEquals(0, CardGame32::compare($card1,$card2));
  }

  public function testCompareSameNameNoSameColor()
  {
    // FAIT
    $card1 = new Card('As', 'Trefle');
    $card2 = new Card('As', 'Pique');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }

  public function testCompareNoSameCardNoSameColor()
  {
    // FAIT
      $card1 = new Card('As', 'Trefle');
      $card2 = new Card('Dame', 'Coeur');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }

  public function testCompareNoSameCardSameColor()
  {
    // FAIT
      $card1 = new Card('Roi', 'Coeur');
      $card2 = new Card('Dame', 'Coeur');
      $this->assertEquals(+1, CardGame32::compare($card1,$card2));

  }


  public function testToString() //
  {
    //FAIT vérifie que la représentation textuelle d'une carte est correcte (vérifier)
      //il affiche la valeur de la carte ici ($card)
      $card = new Card('Dame', 'Coeur');
      $this->assertEquals($card, $card->__toString());
  }


}
