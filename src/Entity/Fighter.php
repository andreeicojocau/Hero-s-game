<?php

namespace Entity;

use ArrayIterator;
use Helpers\Console;

abstract class Fighter
{
  use Console;

  /**
   * Current health 
   */
  protected int $hp;

  /**
   * Current strenght
   */
  protected int $str;

  /**
   * Current defence
   */
  protected int $def;

  /**
   * Current speed
   */
  protected int $speed;

  /**
   * Current luck
   */
  protected int $luck;

  /**
   * Skill list
   */
  protected ArrayIterator $skills;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->initStats();

    if ($this->hasSkills) {
      $this->initSkills();
    }
  }

  /**
   * Generates random stats for the entity
   */
  private function initStats()
  {
    $this->setStats('hp', 'str', 'def', 'speed', 'luck');
  }

  /**
   * Initialize the skills of the entity
   */
  private function initSkills()
  {
    $this->skills = new ArrayIterator();

    foreach ($this->skillSet as $skillName) {
      $class = 'Skill\\' . $skillName;

      if (class_exists($class)) {
        $skill = new $class($this);

        $this->skills->append($skill);
      }
    }
  }

  /**
   * Helper function to set multiple stats at once
   * 
   * @param array $args
   */
  private function setStats(...$arg)
  {
    foreach ($arg as $stat) {
      $min = 'min' . ucfirst($stat);
      $max = 'max' . ucfirst($stat);

      $this->{$stat} = (float) rand($this->{$min}, $this->{$max});
    }
  }

  /**
   * Getter for name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Getter for speed
   */
  public function getSpeed()
  {
    return $this->speed;
  }

  /**
   * Getter for hp
   */
  public function getHp()
  {
    return $this->hp;
  }

  /**
   * Getter for hp
   */
  public function lowerHpBy(int $v)
  {
    $this->hp = max(0, ($this->hp - $v));
  }

  /**
   * Getter for str
   */
  public function getStr()
  {
    return $this->str;
  }

  /**
   * Getter for def
   */
  public function getDef()
  {
    return $this->def;
  }

  /**
   * Getter for luck
   */
  public function getLuck()
  {
    return $this->luck;
  }

  /**
   * Actual attack function that calculates the damage done
   * and if the entity used spells or not also if the attack missed or not
   */
  public function attack(Fighter $entity)
  {
    $damage = $this->str - $entity->def;

    /** Attacker skills check */
    if ($this->hasSkills) {
      foreach ($this->skills as $skill) {
        $damage = $skill->activate('attack', $damage);
      }
    }

    /** Defender's skills check */
    if ($entity->hasSkills) {
      foreach ($entity->skills as $skill) {
        $damage = $skill->activate('defend', $damage);
      }
    }

    /** Checks if the defender is lucky to make the attack miss */
    if (rand(1, 100) < $entity->luck) {
      $this->writeLine($this->getName() . ' missed the attack, ' . $entity->getName() . ' got lucky');
    } else {
      $entity->lowerHpBy($damage);
      $this->writeLine($this->name . ' did a whopping ' . $damage . ' damage to ' . $entity->getName() . ', ' . $entity->getHp() . ' health left');
    }
  }
}
