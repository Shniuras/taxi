<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    public function __construct()
    {
        $this->drivers = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $make;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="car")
     */
    private $trips;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Driver", inversedBy="cars")
     * @ORM\JoinTable(name="car_driver")
     */
    public $drivers;

    public function getId()
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrips()
    {
        return $this->trips;
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->drivers;
    }

    public function addDriver(Driver $driver)
    {
        if($this->drivers->contains($driver)){
            return;
        }
        $this->drivers[] = $driver;
    }

    public function removeDriver(Driver $driver)
    {
        if(! $this->drivers->contains($driver)){
            return;
        }
        $this->drivers->removeElement($driver);
    }
}
