<?php

namespace App\Tests\Core;

use App\Core\Card;
use App\Core\CardGame32;
use App\Core\Guess;
use PHPUnit\Framework\TestCase;

class GuessTest extends TestCase
{
  public function testDefaultValueWithHelp() {
    $guess = new Guess(CardGame32::factoryCardGame32());
    $this->assertTrue($guess->getWithHelp());
  }

  public function testIsMath(){
      $gess = new Guess(CardGame32::factoryCardGame32(), new Card('Roi', 'Pique'));
      $gess1 = new Card('Roi', 'Pique');
      $this->assertTrue($gess->isMatch($gess1));
  }

}
