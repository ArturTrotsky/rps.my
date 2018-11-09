<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistic PRS</title>
</head>

<body>
    <table border="1">
        <caption>Statistics of the game "RPS"</caption>
        <tr>
            <th>Game number</th>
            <th>First Username</th>
            <th>First Username Shape</th>
            <th>Second Username</th>
            <th>Second Username Shape</th>
        </tr>

        <?php
        $gamesDataFull = unserialize(file_get_contents('games.txt'));

        foreach ($gamesDataFull as $keys => $arrays) {
            echo "<tr>";
            echo "<td>$keys</td>";
            foreach ($arrays as $usernames => $shapes) {
                echo "<td>$usernames</td>";
                echo "<td>$shapes</td>";
            }
            echo "</tr>";
        }

var_dump($gamesDataFull);

        ?>
    </table>
</body>
</html>