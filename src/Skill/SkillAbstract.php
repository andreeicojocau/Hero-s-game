<?php

namespace Skill;

use Entity\Fighter;
use Helpers\Console;

abstract class SkillAbstract implements Skill
{
  use Console;

  /**
   * Determines if the skill applies on attack/defennd or both
   */
  protected array $appliesOn = ['attack', 'defend'];

  /**
   * Chance for the spell to be activated
   */
  protected int $chance = 0;

  /**
   * Fighter object
   */
  protected Fighter $entity;

  /**
   * Constructor
   * 
   * @param Fighter $entity
   */
  public function __construct(Fighter $entity)
  {
    $this->entity = $entity;
  }

  /**
   * Checks if it applies
   * 
   * @param string $type
   * 
   * @return bool
   */
  public function doesApply(string $type): bool
  {
    if (!in_array($type, $this->appliesOn)) {
      return false;
    }

    if ($this->chance != 0 && rand(0, 100) > $this->chance) {
      return false;
    }

    $this->writeLine($this->entity->getName() . ' activated the skill: ' . str_replace('Skill\\', '', get_class($this)));

    return true;
  }
}
