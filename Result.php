<?php

class Result implements ResultInterface
{
    private object $army1;

    private object $army2;

    private string $weather;

    public function __construct($army1, $army2, $weather = 'fine')
    {
        $this->army1 = $army1;
        $this->army2 = $army2;
        $this->weather = $weather;
    }

    public function getOverallResult(): array
    {
        list($damage1, $health1) = $this->army1->getArmyDamageHealth($this->weather);
        list($damage2, $health2) = $this->army2->getArmyDamageHealth($this->weather);
        $duration = 0;
        $result1 = $health1;
        $result2 = $health2;
        while ($result1 >= 0 && $result2 >= 0) {
            $result1 -= $damage2;
            $result2 -= $damage1;
            $duration++;
        }
        return [$duration, $result1, $result2];
    }

    public function getEachRowResults(): array
    {
        $eachRowSpecs1 = $this->army1->getEachRowDamageHealth();
        $eachRowSpecs2 = $this->army2->getEachRowDamageHealth();

        $rowsCount = count($eachRowSpecs1);
        $result = [];
        for ($i = 0; $i < $rowsCount; $i++) {
            list($damage1, $health1) = $eachRowSpecs1[$i];
            list($damage2, $health2) = $eachRowSpecs2[$i];
            $duration = 0;
            $result1 = $health1;
            $result2 = $health2;
            while ($result1 >= 0 && $result2 >= 0) {
                $result1 -= $damage2;
                $result2 -= $damage1;
                $duration++;
            }
            $result[] = [$duration, $result1, $result2];
        }
        return $result;
    }


}
