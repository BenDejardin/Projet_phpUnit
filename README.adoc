
# Guess What

Prise en main de la POO avec PHP

Niveau : Deuxième année de BTS SIO SLAM

Prérequis : bases de la programmation, PHP 7 ou supérieur installé sur votre machine de dev.

## Projet 

Ce projet a pour but de mettre en oeuvre de la conception objet et des tests unitaires afin de développer un jeu de carte en php.

On doit faire en sorte que le joueur puisse choisir une carte, proposer une carte et si la carte proposer n'est pas la bonne il sera informer si celui -ci est plus grand ou plus petite que celle à deviner.
Si c'est pas la bonne carte le jeu est terminé sinon il devra proposer à nouveau une nouvelle carte.


## Challenge 1 et 2

Dès le lancement de mon projet avec la commande "php ./bin/phpunit" le système a lancé l'exécution des 8 tests unitaire du dossier "tests" du projet. Cependant, j'ai constaté 4 échecs qui indique qu'il y avait 4 fonctions qui n'étaient pas implémenté dans la classe "CardTest.php'

## Fonction 1 avant implémentation et aprés implémentation :

Cette fonction me demande de comparer deux cartes qui n'ont pas la même couleur mails le même nom et après j'ai écrit la valeur attendu (en précisant la plus grande entre la valeur attendu et la valeur obtenu )
```php
--------->> ## Fonction avant implémentation
public function testCompareSameNameNoSameColor()
  {
    // TODO
    $this->fail("not implemented !");
  }
  
--------->>> ##Fonction aprés implémentation
public function testCompareSameNameNoSameColor()
  {
    // FAIT
    $card1 = new Card('As', 'Trefle');
    $card2 = new Card('As', 'Pique');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }
```
##  Fonction 2 avant implémentation et aprés implémentation :

Cette fonction me demande de comparer deux cartes qui n'ont pas la même couleur ni le même nom et après j'ai écrit la valeur attendu (en précisant la plus grande entre la valeur attendu et la valeur obtenu ) 

```php
--------->> ## Fonction avant implémentation
 public function testCompareNoSameCardNoSameColor()
  {
    // TODO
    $this->fail("not implemented !");
  }

  
--------->>> ##Fonction aprés implémentation
public function testCompareNoSameCardNoSameColor()
  {
    // FAIT
      $card1 = new Card('As', 'Trefle');
      $card2 = new Card('Dame', 'Coeur');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }
```

##  Fonction 3 avant implémentation et aprés implémentation :

Cette fonction me demande de comparer deux cartes qui ont la même couleur mais qui ont le même nom et après j'ai écrit la valeur attendu (en précisant la plus grande entre la valeur attendu et la valeur obtenu )

```php
--------->> ## Fonction avant implémentation
 public function testCompareNoSameNameSameColor()
  {
    // TODO
    $this->fail("not implemented !");
  }


  
--------->>> ##Fonction aprés implémentation
public function testCompareNoSameCardSameColor()
  {
    // FAIT
      $card1 = new Card('Roi', 'Coeur');
      $card2 = new Card('Dame', 'Coeur');
      $this->assertEquals(+1, CardGame32::compare($card1,$card2));

  }
```

## Fonction 4 avant implémentation et aprés implémentation :

Cette fonction permet de vérifier que la représentation textuelle d'une carte est correcte (vérifier) et affiche la valeur de la carte.
```php
--------->> ## Fonction avant implémentation
  public function testToString()
  {
    //TODO vérifie que la représentation textuelle d'une carte est correcte
    $this->fail("not implemented !");
  }



--------->>> ##Fonction aprés implémentation
public function testToString() //
  {
    //FAIT 
      $card = new Card('Dame', 'Coeur');
      $this->assertEquals($card, $card->__toString());
  }
```
## Challenge 3
Pour se challenge j'avais pour objectif d'ajouter une classe test pour la classe "CardGame32.php" que j'ai appelé "CardGame32Test.php"
et d'y créer des méthodes de test qui testent le bon comprotement des objects de cette classe ainsi que ses méthodes statiques.

D'abord dans la classe "CardGame32" j'ai implémenté une fonction factoryCardGame32 qui sert a créer un jeux de 32 carte dans l'ordre.

Pour la création du jeu de carte j'ai préféré utiliser une boucle afin de facilité la création des 32 cartes au lieu d'écrire manuellement les 32 cartes en faisant appèlle à mes 2 constantes "ORDERS_COLORS"  qui prend un tableau de couleur des cartes et "ORDERS_CARDS" qui prend un tableau des noms des cartes.
```php
--------->> ## Fonction avant implémentation
// TODO manque PHPDoc
  public static function factoryCardGame32() : CardGame32 {
     // TODO création d'un jeu de 32 cartes
    $cardGame = new CardGame32([new Card('As', 'Trèfle'), new Card('7', 'Trèfle')]);

    return $cardGame;
  }
--------->> Fonction aprés implémentation
  //boucle afin de facilité la création des 32 cartes au lieu d'écrire manuellement 32 cartes
   public static function factoryCardGame32(): CardGame32
    {
        $cardGame = [];
        $i = 0;
        foreach (array_keys(self::ORDERS_COLORS) as $color) {
            foreach (array_keys(self::ORDERS_CARDS) as $name) {
                $cardGame[$i++] = new Card($name, $color); 
            }
        }
        return new CardGame32($cardGame);
    }
   
```
## Création des méthodes de test ainsi que ses méthodes statiques (CardGmae32Test.php).
Par exemple dans cette classe de test j'ai fait une fonction qui vérifie si la création des 32 cartes a bien été créé en faisant appele à la fonction factoryCardGame32 dans la classe CardGame32
```php
--------->vérification de 32 cartes

 public function testToString32Cards()
    {
        //mettre dans carte game 32test
        $cardGame = CardGame32::factoryCardGame32();
        $this->assertEquals('CardGame32 : 32 carte(s)', $cardGame->__toString());
    }
```
On a aussi une fonction qui permet de mélanger 1 paquet de cartes. Le "gardGame" qui est mélanger et le "cardGame2" qui ne l'est pas.
Cette fonction fonctionne grace au "fonction shuffle" de la classe "CardGame32" car on fait appelle a cette fonction dans la classe "CardGame32test

```php
---------> Mélange

 public function shuffle()
    {
        // FAIT (voir les fonctions sur les tableaux)
        shuffle($this->cards); //mélanger les élément
    }
```
```php
---------> Mélange de paquets de cartes

 public function testShuffle()
    {
        $cardGameMelange = CardGame32::factoryCardGame32();
        $cardGameMelange->shuffle();
        $cardGame = CardGame32::factoryCardGame32();
        $this->assertNotEquals($cardGameMelange, $cardGame);
    }
```
J'ai aussi réaliser plusier test dans cette classe afin de vérifier les différents possibilité.

