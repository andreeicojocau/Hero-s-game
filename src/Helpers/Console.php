<?php

namespace Helpers;

trait Console
{
  /**
   * Gets the input from the user
   *
   * @return string $input
   */
  public function getInput(): string
  {
    $input = trim(fgets(STDIN));

    return $input;
  }

  /**
   * Writes line to the console
   *
   * @param  string $message
   * @return void
   */
  public function writeLine(string $message)
  {
    fwrite(STDOUT, "{$message}\n");
  }

  /**
   * @param  int $roundNr
   * @param  string $heroName
   * @param  string $enemyName
   */
  public function newRoundMessage(int $roundNr, string $heroName, string $enemyName)
  {
    $message = <<<EOD
------------------------------------
|*******     ROUND {$roundNr}      ******** |
|***** {$heroName} vs {$enemyName} ***** |
------------------------------------
EOD;

    $this->writeLine($message);
  }

  public function startMessage()
  {
    $message = <<<EOD
------------------------------------
|********     START     ********** |
|******** {$this->name} ********** |
------------------------------------
EOD;

    $this->writeLine($message);
  }

  public function endMessage()
  {
    $message = <<<EOD
------------------------------------
|********    THE END    ********** |
|******** {$this->name} ********** |
------------------------------------
EOD;

    $this->writeLine($message);
  }
}
