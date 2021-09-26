<?php

namespace Entity;

class Enemy extends Fighter
{
  /** 
   * Constants for entity's stats */
  protected $minHp = 60;

  protected $maxHp = 90;

  protected $minStr = 60;

  protected $maxStr = 90;

  protected $minDef = 40;

  protected $maxDef = 60;

  protected $minSpeed = 40;

  protected $maxSpeed = 60;

  protected $minLuck = 25;

  protected $maxLuck = 40;
  /** End constants for stats */

  /** 
   * Entity's name
   */
  protected string $name = 'Wild beast';

  /**
   * Determines if the entity has skills or not
   */
  protected bool $hasSkills = false;
}
