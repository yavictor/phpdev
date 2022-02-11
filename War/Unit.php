<?php

class Unit implements UnitInterface
{
    private array $params = array(
        "health" => 0,
        "armour" => 0,
        "damage" => 0
    );

    private string $name = '';

    public function __construct($name, $health, $armour, $damage)
    {
        $this->name = $name;
        $this->params["health"] = $health;
        $this->params["armour"] = $armour;
        $this->params["damage"] = $damage;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHealth(): int
    {
        return $this->params["health"];
    }

    public function getArmour(): int
    {
        return $this->params["armour"];
    }

    public function setArmour($amount): void
    {
        $this->params["armour"] = $amount;
    }

    public function getDamage(): int
    {
        return $this->params["damage"];
    }

    public function setDamage($amount): void
    {
        $this->params["damage"] = self::getDamage() * $amount;
    }

}
