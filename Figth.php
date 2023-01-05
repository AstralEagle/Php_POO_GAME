<?php

require_once("./Monster.php");
require_once("./Player.php");

class Figth
{
    private Player $player;
    private Monster $monster;
    private int $round;
    private bool $run;


    public function __construct(Player $player, Monster $monster)
    {
        $this->round = 1;
        $this->run = false;
        $this->player = $player;
        $this->monster = $monster;
    }

    public function launch(): void
    {
        print_r("//---  Le combat entre " . $this->player->getName() . " et " . $this->monster->getName() . " commence!!  ---//\n");
        $this->playerTurn();
    }

    // Entity turn
    private function playerTurn(): void
    {
        print_r("//------------------------------------------------------//\n\n");
        print_r("Round " . $this->round . "\n\n");
        print_r($this->player->getName() . " : " . $this->player->getStamina() . " Stamina");
        $this->playerChoise();
        if ($this->run) {
        } else if ($this->monster->isDead()) {
            $this->end($this->player);
        } else {
            sleep(1);
            $this->monsterTurn();
        }
    }

    private function monsterTurn(): void
    {
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
        print_r("\n\nQue choississez vous de faire?\n1- Attaquer\n2- Se Soigner\n3- Fuire\n");
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        print_r("\n");

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
            case "view":
                $this->playSecretView();
                $this->playerChoise();
                break;
            case "buff":
                $this->playerSecretBuff();
                $this->playerChoise();
                break;
            default:
                print_r("Commande non reconnu");
                $this->playerChoise();
        }
    }

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

    private function playerRun(): void
    {
        print_r("Vous tentez de fuire.");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);

        if (random_int(1, 3) == 1) {
            $this->run = true;
            print_r("\nVous fuyez le combat!");

        } else {
            print_r("\nVous echouez dans votre tentative de fuite.\n");
        }
    }

    private function playSecretView(): void
    {
        print_r("Vous observer l'ennemie.");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        $isRun = random_int(1, 10) < 8;
        if (random_int(1, 10) < 8) {
            print_r("\nVous remarquer que " . $this->monster->getName() . " a " . $this->monster->getStamina() . " Stamina. \n");
        } else {
            print_r("\nMalheureusement vous ne remarquer rien...");
        }

    }

    private function playerSecretBuff():void
    {
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r(".");
        sleep(1);
        print_r("\n\nUne Lumière Divine vous recouvre, vous sentez que votre force augmente grandement.\n");
        $this->player->setPower(500);
    }

    //
    private function end(Entity $winner): void
    {
        print_r($winner->getName() . " est le grand gagnant du combat!");
    }

}