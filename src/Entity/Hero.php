<?php

namespace Entity;

class Hero extends Fighter
{
  /** Constants for entity's limits stats */
  protected $minHp = 70;

  protected $maxHp = 100;

  protected $minStr = 70;

  protected $maxStr = 80;

  protected $minDef = 45;

  protected $maxDef = 55;

  protected $minSpeed = 40;

  protected $maxSpeed = 50;

  protected $minLuck = 10;

  protected $maxLuck = 30;
  /** End constants for entity's limits stats */

  /** 
   * Entity's name
   */
  protected string $name = 'Orderus';

  /**
   * Determines if the entity has skills or not
   */
  protected bool $hasSkills = true;

  /**
   * Skill classes
   */
  protected array $skillSet = ['MagicShield', 'RapidStrike'];
}
