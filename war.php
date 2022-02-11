<?php

include './UnitInterface.php';
include './ArmyInterface.php';
include './ResultInterface.php';
include './Unit.php';
include './Army.php';
include './Result.php';


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


$result = new \Result($army1, $army2);
$eachRowResults = $result->getEachRowResults();

list($duration, $result1, $result2) = $result->getOverallResult();

$iceResult = new \Result($army1, $army2, 'ice');
list($iceDuration, $iceResult1, $iceResult2) = $iceResult->getOverallResult();

$rainResult = new \Result($army1, $army2, 'rain');
list($rainDuration, $rainResult1, $rainResult2) = $rainResult->getOverallResult();
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
