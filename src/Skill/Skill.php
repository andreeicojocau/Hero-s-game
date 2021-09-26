<?php

namespace Skill;

interface Skill
{
  /**
   * Checks if it can apply
   */
  public function doesApply(string $type);

  /**
   * Actual spell activation
   * Does activate if doesApply is true
   * Should figure out how to do a entity modifier as well
   * Not only damage modifier
   * 
   * @param string $type
   * @param int $damage
   */
  public function activate(string $type, int $damage);
}
