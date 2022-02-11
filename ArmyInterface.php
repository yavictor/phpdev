<?php

interface ArmyInterface
{
    public function __construct(string $name, array $units);

    public function getName(): string;

    public function getUnits(): array;

    public function getUnitsString(): string;

    public function getArmyDamageHealth($weather): array;

    public function getEachRowDamageHealth(): array;
}
