<?php

use Entity\Enemy;
use Entity\Fighter;
use Entity\Hero;
use Helpers\Console;

class Round
{
  use Console;

  /**
   * Rounds winner
   */
  private Fighter $winner;

  /**
   * Hero object
   */
  private Hero $hero;

  /**
   * Enemy object
   */
  private Enemy $enemy;

  /**
   * Round number
   */
  private int $roundNr;

  /**
   * Who is attacking
   */
  private Fighter $attacker;

  /**
   * Who is defending
   */
  private Fighter $defender;

  /**
   * Constructor
   * @param int $roundNr
   */
  public function __construct($roundNr)
  {
    $this->roundNr  = $roundNr;
    $this->hero     = new Hero();
    $this->enemy    = new Enemy();

    $this->newRoundMessage($this->roundNr, $this->hero->getName(), $this->enemy->getName());
  }

  /**
   * Fight action
   */
  public function fight()
  {
    $this->decideWhoGoesFirst();

    while (true) {
      $this->attacker->attack($this->defender);
      sleep(1);

      if ($this->checkForWinner()) {
        break;
      }

      $this->swapRoles();
    }

    $this->writeLine('Round ' . $this->roundNr . ' won by ' . $this->getWinner()->getName());

    /** Checks if hero died */
    if ($this->hero->getHp() <= 0) {
      return false;
    }

    return true;
  }

  /**
   * Decides who goes first and sets initial attacker and defender
   */
  private function decideWhoGoesFirst()
  {
    if ($this->hero->getSpeed() == $this->enemy->getSpeed()) {
      if ($this->hero->getLuck() == $this->enemy->getLuck()) {
        /** Since this is not specified */
        $this->attacker = $this->hero;
        $this->defender = $this->enemy;
      } else if ($this->hero->getSpeed() > $this->enemy->getSpeed()) {
        $this->attacker = $this->hero;
        $this->defender = $this->enemy;
      } else {
        $this->attacker = $this->enemy;
        $this->defender = $this->hero;
      }
    } else if ($this->hero->getSpeed() > $this->enemy->getSpeed()) {
      $this->attacker = $this->hero;
      $this->defender = $this->enemy;
    } else {
      $this->attacker = $this->enemy;
      $this->defender = $this->hero;
    }
  }

  /**
   * Swaps defender with attacker
   */
  private function swapRoles()
  {
    if ($this->attacker instanceof Hero) {
      $this->attacker = $this->enemy;
      $this->defender = $this->hero;
    } else {
      $this->attacker = $this->hero;
      $this->defender = $this->enemy;
    }
  }

  /**
   * Checks for winner every attack
   */
  private function checkForWinner()
  {
    if ($this->defender->getHp() <= 0) {
      $this->winner = $this->attacker;

      return true;
    }

    return false;
  }

  /**
   * Getter for the round winner
   */
  public function getWinner(): Fighter
  {
    return $this->winner;
  }

  /**
   * Getter for hero
   */
  public function getHero()
  {
    return $this->hero;
  }

  /**
   * Getter for the enemy
   */
  public function getEnemy()
  {
    return $this->enemy;
  }
}
