<?php

class Animal
{
    protected $species = "Unknown";

    protected function getSpecies()
    {
        return $this->species;
    }
}

class Dog extends Animal
{
    public function showSpecies()
    {
        return $this->getSpecies();
    }
}

$dog = new Dog();
echo $dog->showSpecies();
