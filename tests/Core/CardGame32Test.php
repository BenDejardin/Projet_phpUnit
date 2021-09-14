<?php

namespace App\Tests\Core;
// l'endroit ou se trouve la classe

use App\Core\CardGame32;
use PHPUnit\Framework\TestCase;
use App\Core\Card;

class CardGame32Test extends TestCase
{

    public function testToString1Card()
    {
        //mettre dans carte game 32test
        $cardGame = new CardGame32([new card('Dame', 'Coeur')]);
        $this->assertEquals('CardGame32 : 1 carte(s)', $cardGame->__toString());
    }

    public function testToString2Cards()
    {
        //mettre dans carte game 32test
        $cardGame = new CardGame32([new card('Dame', 'Coeur'), new card('Roi', 'Coeur')]);
        $this->assertEquals('CardGame32 : 2 carte(s)', $cardGame->__toString());
    }

    public function testToString32Cards() // je test s'il y a 32 carte
    {
        //mettre dans carte game 32test
        $cardGame = CardGame32::factoryCardGame32(); //je fais appèl à la fonction qui est dans cardGame32
        $this->assertEquals('CardGame32 : 32 carte(s)', $cardGame->__toString());
    }

    public function testGetCard()
    {
        $card = new CardGame32([new Card('Dame', 'Coeur')]);
        $this->assertEquals(new Card('Dame', 'Coeur'), $card->getCard(0));
    }

    public function testShuffle() // création de 2 paquet de cartes gardGame qui est mélanger et le cardGame2 qui ne l'est pas
    {
        $cardGameMelange = CardGame32::factoryCardGame32();
        $cardGameMelange->shuffle();
        $cardGame = CardGame32::factoryCardGame32();
        $this->assertNotEquals($cardGameMelange, $cardGame);
    }

    public function testFactoryCardGame32()
    {
        $cardGame = CardGame32::factoryCardGame32();
        $index = 0;
        $card = $cardGame->getCard($index); //je prend la carte indexer
        $this->assertEquals('7', $card->getName());
        $this->assertEquals('carreau', $card->getColor());
        $this->assertEquals('CardGame32 : 32 carte(s)', $cardGame->__toString());
    }

    public function testCompareSameCard()
    {
        $cardGame = CardGame32::factoryCardGame32();
        $index = 0;
        $card = $cardGame->getCard($index);
        $card1 = $cardGame->getCard($index);
        $this->assertEquals(0, CardGame32::compare($card, $card1));
    }

    public function testCompareSameNameNoSameColor()
    {
        $cardGame = CardGame32::factoryCardGame32();
        $index0 = 0;
        $index8 = 8;
        $card = $cardGame->getCard($index0);
        $card1 = $cardGame->getCard($index8);
        $this->assertEquals(-1, CardGame32::compare($card, $card1));
    }

    public function testCompareNoSameCardNoSameColor()
    {
        $cardGame = CardGame32::factoryCardGame32();
        $index0 = 0;
        $index9 = 9;
        $card = $cardGame->getCard($index9);
        $card1 = $cardGame->getCard($index0);
        $this->assertEquals(+1, CardGame32::compare($card, $card1));

    }

    public function testCompareNoSameCardSameColor()
    {
        $cardGame = CardGame32::factoryCardGame32();
        $index2 = 2;
        $index3 = 3;
        $card = $cardGame->getCard($index2);
        $card1 = $cardGame->getCard($index3);
        $this->assertEquals(-1, CardGame32::compare($card, $card1));
    }

}