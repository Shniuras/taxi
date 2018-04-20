<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalculatorRepository")
 */
class Calculator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function add($a, $b) : float
    {
        $this->validateInput($a, $b);
        return $a + $b;
    }

    public function subtract($a, $b) : float
    {
        $this->validateInput($a, $b);
        return $a - $b;
    }

    /**
     * @param $a
     * @param $b
     */
    protected function validateInput($a, $b): void
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \UnexpectedValueException();
        }
    }
}
