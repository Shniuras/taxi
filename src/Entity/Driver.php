<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    public function __construct()
    {
        $this->cars = new ArrayCollection();
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
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $license;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Car", mappedBy="drivers")
     *
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="driver")
     */
    private $trips;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCars()
    {
        return $this->cars;
    }

    public function addCar(Car $car)
    {
        if($this->cars->contains($car)){
            return;
        }
            $car->addDriver($this);
            $this->cars[] = $car;
    }

    public function removeCar(Car $car)
    {
        if(! $this->cars->contains($car)){
            return;
        }
        $car->removeDriver($this);
        $this->cars->removeElement($car);
    }

    public function getTrips()
    {
        return $this->trips;
    }

}
