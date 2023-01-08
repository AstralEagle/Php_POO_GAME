<?php

namespace App\Controlleur;

use App\Model\AbstractEntity;
use App\Model\Monster;
use App\Model\Player;

class FightController
{
    private Player $player;
    private Monster $monster;
    private int $round;
    private bool $run;

// Constructeur de l'objet Fight
    public function __construct(Player $player, Monster $monster)
    {
        $this->round = 1;
        $this->run = false;
        $this->player = $player;
        $this->monster = $monster;
    }

    // Fonction qui permet de lancer le combat entre les 2 entités
    public function launch(): void
    {
        print_r("//---  Le combat entre " . $this->player->getName() . " et " . $this->monster->getName() . " commence!!  ---//\n");
        $this->playerTurn();
    }

    // AbstractEntity turn

    //Fonction appellé quand c'est le tour du joueur
    private function playerTurn(): void
    {
        print_r("//------------------------------------------------------//\n\n");
        print_r("Round " . $this->round . "\n\n");
        print_r($this->player->getName() . " : " . $this->player->getStamina() . " Stamina");
        $this->playerChoise();
        /*
         * On verifie si le joueur a fuit le combat lors de son action
         * Si oui on fini la la function sans rien faire
         * Sinon on verifie si le monstre est encore en vie
         */
        if ($this->run) {
        } else if ($this->monster->isDead()) {
            $this->end($this->player);
        } else {
            sleep(1);
            $this->monsterTurn();
        }
    }

    //Fonction appellé quand c'est le tour du monstre
    private function monsterTurn(): void
    {
        /*
         * On va attendre quel que seconde puis lancer une attaque sur le joueur avec l'attaque du monstre
         * Puis on verifie si le joueuer est mort
         */
        print_r("\n.");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".\n\n");
        $this->monsterAttack();
        sleep(1);
        if ($this->player->isDead()) {
            $this->end($this->monster);
        } else {
            sleep(1);
            print_r("\n\n");
            $this->round++;
            $this->playerTurn();

        }
    }

    private function playerChoise(): void
    {
        //On va afficher un choix pour le joueur avec un choix libre
        print_r("\n\nQue choississez vous de faire?\n1- Attaquer\n2- Se Soigner\n3- Fuire\n\n");
        /*
         * Code qui permet de récuperer le texte que rentre l'utilisateur dans le terminal
         * J'avoue j'ai trouver ça sur internet... Mais ça fonctionne
         */
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        print_r("\n");
        // On fait un switch par rapport au texte recuperer dans le terminal pour effectuer une action
        switch (trim($line)) {
            case "1":
                $this->playerAttack();
                break;
            case "2":
                $this->playerHeal();
                break;
            case "3":
                $this->playerRun();
                break;
            //Action bonus (Cacher)
            case "view":
                $this->playSecretView();
                $this->playerChoise();
                break;
            case "buff":
                $this->playerSecretBuff();
                $this->playerChoise();
                break;
            case "attack":
                $this->playerSecretAttack();
                break;
            // Si le texte recuperer n'est pas dans les option définie au dessus, on relance cette fonction
            default:
                print_r("Commande non reconnu");
                $this->playerChoise();
        }
    }

    /*
     * Ici on va ecrire toute les fonction qui sont des action des entity (A modifier si on veux encore plus déconstruire le code)
     */

// Monster action
    private function monsterAttack(): void
    {
        $this->player->getDamage($this->monster->attack());
    }

// Player action
    private function playerAttack(): void
    {
        $this->monster->getDamage($this->player->attack());
    }

    private function playerHeal(): void
    {
        $this->player->heal();
    }

    // Ici on a les action un peut particulière que je n'ai pas définie dans les Entity
    private function playerRun(): void
    {
        print_r("Vous tentez de fuire.");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);

        // On fait un rand pour savoir si l'utilisateur arrive a fuire ( 1 chance sur 3 )
        if (random_int(1, 3) == 1) {
            $this->run = true;
            print_r("\nVous fuyez le combat!");

        } else {
            print_r("\nVous echouez dans votre tentative de fuite.\n");
        }
    }

    /*
     *  Permet de recuperer les information sur le monstre
     *  Ne fait pas utiliser l'action du joueur mais c'est défini dans le switch lors de la section d'action
     */
    private function playSecretView(): void
    {
        print_r("Vous observer l'ennemie.");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        if (random_int(1, 10) < 8) {
            print_r("\nVous remarquer que " . $this->monster->getName() . " a " . $this->monster->getStamina() . " Stamina. \n");
        } else {
            print_r("\nMalheureusement vous ne remarquer rien...");
        }

    }

    /*
     *  On va augmenter les stats du joueur de 500 point
     *  Ne fait pas utiliser l'action du joueur mais c'est défini dans le switch lors de la section d'action
     */
    private function playerSecretBuff(): void
    {
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r("\n\nLe Dieu de la colère vous donner ça force, vous vous sentez beaucoup plus fort.\n");
        $this->player->levelUp(500);
    }

    // Attaque 10 fois plus puissante
    private function playerSecretAttack(): void
    {
        print_r("\n\nVous prennez une grande inspiration.");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r("\n");

        $this->monster->getDamage($this->player->attack() * 10);
    }

    // Fonction qui est appeller lors que l'une des Entity est tuer
    private function end(AbstractEntity $winner): void
    {
        print_r("\n" . $winner->getName() . " est le grand gagnant du combat!\n\n");
        print_r("//-------------------  Fin du combat  ------------------//\n");
        if ($winner === $this->player) {
            $this->player->levelUp($this->monster->getStats());
            print_r("Vos statistiques augmente! \n");
            sleep(2);
        } else {
            print_r("GAME OVER\n\n\n");
        }
    }
}