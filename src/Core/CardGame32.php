<?php

namespace App\Core;

/**
 * Class CardGame32 : un jeu de cartes.
 * @package App\Core
 */
class CardGame32
{
    //tableau des cartes et des couleurs
    const ORDERS_COLORS = ['carreau' => 1, 'pique' => 2, 'coeur' => 3, 'trefle' => 4];
    const ORDERS_CARDS = ['7' => 1, '8' => 2, '9' => 3, '10' => 4, 'valet' => 5, 'dame' => 6, 'roi' => 7, 'as' => 8];
    /**
     * @var $cards array a array of Cards
     */
    private $cards;

    /**
     * Guess constructor.
     * @param array $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * Brasse le jeu de cartes
     */
    public function shuffle()
    {
        // FAIT (voir les fonctions sur les tableaux)
        shuffle($this->cards); //mélanger les élément
    }

    // TODO ajouter une méthode reOrder qui remet le paquet en ordre

    /** définir une relation d'ordre entre instance de Card.
     * à valeur égale (name) c'est l'ordre de la couleur qui prime
     * coeur > carreau > pique > trèfle
     * Attention : si AS de Coeur est plus fort que AS de Trèfle,
     * 2 de Coeur sera cependant plus faible que 3 de Trèfle
     *
     *  Remarque : cette méthode n'est pas de portée d'instance (static)
     *
     * @see https://www.php.net/manual/fr/function.usort.php
     *
     * @param $c1 Card
     * @param $c2 Card
     * @return int
     * <ul>
     *  <li> zéro si $c1 et $c2 sont considérés comme égaux </li>
     *  <li> -1 si $c1 est considéré inférieur à $c2</li>
     * <li> +1 si $c1 est considéré supérieur à $c2</li>
     * </ul>
     *
     */
    public static function compare(Card $c1, Card $c2): int
    {
        // FAIT code naïf, et de plus il faudra prendre en compte la couleur !

        // variable des noms de  la carte1 et carte2
        $c1Name = strtolower($c1->getName());
        $c2Name = strtolower($c2->getName());


        // variable des color de la carte1 et carte2
        $c1Color = strtolower($c1->getColor());
        $c2Color = strtolower($c2->getColor());

        //comparaison des cartes et des couleurs
        if (self::ORDERS_CARDS[$c1Name] === self::ORDERS_CARDS[$c2Name] && self::ORDERS_COLORS[$c1Color] === self::ORDERS_COLORS[$c2Color]) {
            return 0;
        }
        if (self::ORDERS_CARDS[$c1Name] === self::ORDERS_CARDS[$c2Name]) {
            return (self::ORDERS_COLORS[$c1Color] > self::ORDERS_COLORS[$c2Color]) ? +1 : -1;
        }
        return (self::ORDERS_CARDS[$c1Name] > self::ORDERS_CARDS[$c2Name]) ? +1 : -1;

    }

    // FAIT manque PHPDoc

    /**
     * @return CardGame32
     */

    public static function factoryCardGame32(): CardGame32 //sert a créer un jeux de carte de 32 dans l'ordre
    {
        // FAIT création d'un jeu de 32 cartes qui me permet de crer un tableau que je met dans cartgame32
        /*$cardGame = new CardGame32([new Card('As', 'Trefle'), new Card('2', 'Trefle')]);

        return $cardGame;
        */

        //boucle afin de facilité la création des 32 cartes au lieu d'écrire manuellement 32 cartes
        $cardGame = [];
        $i = 0;
        foreach (array_keys(self::ORDERS_COLORS) as $color) {
            foreach (array_keys(self::ORDERS_CARDS) as $name) {
                $cardGame[$i++] = new Card($name, $color); //probmème rencontrer je n'avais pas mis $i++ en php soit on peut ne rien mettre dans les crochet ce qui fait que le $i ne sert à rien
            }
        }
        return new CardGame32($cardGame);
    }

    // FAIT manque PHPDoc

    /**
     * @param $index
     * @return Card
     */

    public function getCard($index): Card
    {
        // FAIT
        if ($index >= 0 && $index < 32)   //rencontrer un problème car j'avais mis $index<=32 j'avais oublié de prendre en compte le 0
            return $this->cards[$index];
    }

    public function __toString()
    {
        /*return 'CardGame32 : 1' .'carte(s)';*/
        return 'CardGame32 : ' . count($this->cards) . ' carte(s)';
    }

}

