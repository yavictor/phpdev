<?php

interface UnitInterface
{
    public function __construct(string $name, int $health, int $armour, int $damage);

    public function getName(): string;

    public function getHealth(): int;

    public function getArmour(): int;

    public function setArmour($amount): void;

    public function getDamage(): int;

    public function setDamage($amount): void;
}
