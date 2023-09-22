<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class Game
{
    use DefaultActionTrait;

    #[LiveProp()]
    public bool $running = false;

    #[LiveProp()]
    public bool $gameOver = false;

    #[LiveProp()]
    public array $asteroids = [];


    #[LiveProp()]
    public int $spaceship = 5;

    #[LiveProp()]
    public int $score = 0;


    #[LiveAction()]
    public function addAsteroid()
    {
        if (isset($this->asteroids[9]) && $this->spaceship === $this->asteroids[9]) {
            $this->gameOver = true;
            $this->running = false;
        } else {
            $this->score++;
            array_unshift($this->asteroids, rand(0, 9));
            if (count($this->asteroids) > 10) {
                array_pop($this->asteroids);
            }
        }
    }

    #[LiveAction()]
    public function toggleRunning()
    {
        $this->running = !$this->running;
    }

    #[LiveAction()]
    public function moveLeft()
    {
        if ($this->spaceship > 0 && $this->running) {
            $this->spaceship--;
        }
    }

    #[LiveAction()]
    public function moveRight()
    {
        if ($this->spaceship < 9 && $this->running) {
            $this->spaceship++;
        }
    }
}
