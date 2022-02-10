<?php

include './UnitInterface.php';
include './Unit.php';
include './Army.php';

$infantry = new \Unit('infantry',100, 10, 10);
$archers = new \Unit('archers', 100, 5, 20);
$cavalry = new \Unit('cavalry', 300, 30, 30);

$army1 = new \Army('Александр Ярославич', [
    [$infantry, 200],
    [$archers, 30],
    [$cavalry, 15],
]);

$army2 = new \Army('Ульф Фасе', [
    [$infantry, 90],
    [$archers, 65],
    [$cavalry, 25],
]);

function getOverallResult($army1, $army2, $weather = 'fine'): array
{
    list($damage1, $health1) = $army1->getArmyDamageHealth($weather);
    list($damage2, $health2) = $army2->getArmyDamageHealth($weather);
    $duration = 0;
    $result1 = $health1;
    $result2 = $health2;
    while ($result1 >= 0 && $result2 >= 0) {
        $result1 -= $damage2;
        $result2 -= $damage1;
        $duration++;
    }
    return [$duration, $result1, $result2];
};

function getEachRowResults($army1, $army2): array
{
    $eachRowSpecs1 = $army1->getEachRowDamageHealth();
    $eachRowSpecs2 = $army2->getEachRowDamageHealth();

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
};

$eachRowResults = getEachRowResults($army1, $army2);

list($duration, $result1, $result2) = getOverallResult($army1, $army2);

list($iceDuration, $iceResult1, $iceResult2) = getOverallResult($army1, $army2, 'ice');

list($rainDuration, $rainResult1, $rainResult2) = getOverallResult($army1, $army2, 'rain');
?>

    <table border="1">
        <tr>
            <th></th>
            <th><?=$army1->getName()?></th>
            <th><?=$army2->getName()?></th>
        </tr>
        <tr>
            <th>Army units:</th>
            <td><?=$army1->getUnitsString()?></td>
            <td><?=$army2->getUnitsString()?></td>
        </tr>
        <tr>
            <th>Health after <?=$duration?> hits:</th>
            <td><?=$result1?></td>
            <td><?=$result2?></td>
        </tr>
        <tr>
            <th>Health after <?=$iceDuration?> hits on ice:</th>
            <td><?=$iceResult1?></td>
            <td><?=$iceResult2?></td>
        </tr>
        <tr>
            <th>Health after <?=$rainDuration?> hits on rain:</th>
            <td><?=$rainResult1?></td>
            <td><?=$rainResult2?></td>
        </tr>
        <?php foreach ($eachRowResults as $i => [$eachDuration, $eachResult1, $eachResult2]): ?>
        <tr>
            <th>Health of <?=$i+1?> row after <?=$eachDuration?> hits:</th>
            <td><?=$eachResult1?></td>
            <td><?=$eachResult2?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th>Result overall</th>
            <td><?=$result1 > $result2 ? 'WINNER' : 'LOOSER'?></td>
            <td><?=$result2 > $result1 ? 'WINNER' : 'LOOSER'?></td>
        </tr>
    </table>
