<?php

class Army
{
    private array $units = [];

    private string $name = '';

    public function __construct(string $name, array $units)
    {
        $this->name = $name;
        $this->units = $units;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnits(): array
    {
        return $this->units;
    }

    public function getUnitsString(): string
    {
        $result = '';
        foreach ($this->getUnits() as [$units, $count]) {
            $result .= "{$units->getName()}: {$count}, ";
        }
        return substr($result,0,-2) . '.';
    }

    function getArmyDamageHealth($weather): array
    {
        $damage = 0;
        $health = 0;

        foreach ($this->units as [$units, $count]) {
            if ($weather === 'ice' && $units->getName() === 'cavalry') {
                $units->setArmour(0);
            }
            if ($weather === 'rain' && $units->getName() === 'archers') {
                $units->setDamage(0,5);
            }
            $damage += $units->getDamage() * $count;
            $health += $units->getHealth() * $count + $units->getArmour() * $count;
        }

        return [$damage, $health];
    }

    function getEachRowDamageHealth(): array
    {
        $result = [];
        foreach ($this->units as [$units, $count]) {
            $damage = $units->getDamage() * $count;
            $health = $units->getHealth() * $count + $units->getArmour() * $count;
            $result[] = [$damage, $health];
        }
        return $result;
    }
}
