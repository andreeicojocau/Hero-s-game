<?php

declare(strict_types=1);

use Entity\Hero;
use Entity\Enemy;
use Entity\Fighter;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
  public function testGameCanStart(): void
  {
    $this->assertInstanceOf(
      Game::class,
      Game::getInstance()
    );
  }

  public function testHeroCreation(): void
  {
    $hero = new Hero();

    $this->assertNotNull($hero);
    $this->assertIsObject($hero);
    $this->assertIsScalar($hero->getHp());
    $this->assertClassHasAttribute('skillSet', Hero::class);
    $this->assertObjectHasAttribute('skills', $hero);
  }

  public function testEnemyCreation(): void
  {
    $enemy = new Enemy();

    $this->assertNotNull($enemy);
    $this->assertIsObject($enemy);
    $this->assertIsScalar($enemy->getHp());
    $this->assertClassNotHasAttribute('skillSet', Enemy::class);
  }

  public function testRoundFight(): void
  {
    $round = new Round(1);

    $this->assertNotNull($round->getEnemy());
    $this->assertNotNull($round->getHero());
    $this->assertInstanceOf(Enemy::class, $round->getEnemy());
    $this->assertInstanceOf(Hero::class, $round->getHero());
    
    $result = $round->fight();

    $this->assertIsBool($result);
    $this->assertNotNull($round->getWinner());
    $this->assertInstanceOf(Fighter::class, $round->getWinner());
  }
}
