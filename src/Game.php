<?php

use Helpers\Console;

class Game
{
  use Console;

  /**
   * Game's instance
   */
  private static $instance;

  /**
   * Number of rounds to play
   */
  private const ROUND_NUMBER = 20;

  /**
   * Name of the game
   */
  private $name = 'THE HERO GAME';

  /**
   * Winner of the game
   */
  private $winner;

  /**
   * Rounds archive
   */
  private ArrayIterator $rounds;

  /**
   * Private constructor
   */
  private function __construct()
  {
    $this->checkIfConsole();
    $this->startMessage();
    $this->rounds = new ArrayIterator();
  }

  /**
   * Init function to create the game instance
   */
  public static function getInstance(): self
  {
    if (!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /**
   * Game start
   */
  public function run()
  {
    sleep(1);
    $counter = 1;

    while ($counter <= self::ROUND_NUMBER) {
      $round = new Round($counter);

      $continue = $round->fight();
      $this->rounds->offsetSet($counter, $round);

      if (!$continue) {
        $this->writeLine('Unfortunately hero died. GAME OVER');

        break;
      }

      $counter++;
    }

    $this->endMessage();
  }

  /**
   * Checks if app is running from console
   */
  private function checkIfConsole()
  {
    if (php_sapi_name() != 'cli') {
      throw new Exception('Script is made for console only');
      die;
    }
  }
}
