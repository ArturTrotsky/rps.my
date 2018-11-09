<?php

function getAllGamesData()
{
    if (!file_exists(GAMES_FILE)) {
        file_put_contents(GAMES_FILE, serialize([]));
    }

    return unserialize(file_get_contents(GAMES_FILE));
}

function saveGameData($data)
{
    $gamesData = getAllGamesData();
    
    echo '$gamesData = ';                        /////////////////
    var_dump($gamesData);                        /////////////////
    echo '<br />';                               /////////////////
    
    echo 'count($gamesData) = ';                 /////////////////
    $c = count($gamesData);                      /////////////////
    echo $c;                                     /////////////////
    echo '<br />';                               /////////////////


    $lastIndex = count($gamesData) - 1;

    echo '$lastIndex = ';                        /////////////////
    echo $lastIndex;                             /////////////////
    echo '<br />';                               /////////////////


    echo 'count($data) = ';                      /////////////////
    $p = count($data);                           /////////////////
    echo $p;                                     /////////////////
    echo '<br />';                               /////////////////

    if (count($data) === 1) {
        $gamesData[] = $data;

        echo '$data = ';                         /////////////////
        var_dump($data);                         /////////////////
        echo '<br />';                           /////////////////

        echo '$gamesData[] = ';                  /////////////////
        var_dump($gamesData);                    /////////////////
        echo '<br />';                           /////////////////


    } else {
        $gamesData[$lastIndex] = $data;


        echo '$data = ';                         /////////////////
        var_dump($data);                         /////////////////
        echo '<br />';                           /////////////////

        echo '$lastIndex = ';                    /////////////////
        echo $lastIndex;                         /////////////////
        echo '<br />';                           /////////////////
              
        echo '$gamesData[$lastIndex] = ';        /////////////////
        var_dump($gamesData);                    /////////////////
        echo '<br />';                           /////////////////

    }

    file_put_contents(
        GAMES_FILE,
        serialize($gamesData)
    );

    return count($gamesData) - 1;
}


function getGameData()
{
    $gamesData = getAllGamesData();

    echo '$gamesData = ';                        /////////////////
    var_dump($gamesData);                        /////////////////
    echo '<br />';                               /////////////////

    $gameData = [];

    $lastIndex = count($gamesData) - 1;
    if ($lastIndex > -1) {
        $lastGameData = $gamesData[$lastIndex];
        $lastCount = count($lastGameData);

        if ($lastCount === 1) {
            $gameData = $lastGameData;
        }
    }

    return $gameData;
}

function playRockPaperScissors($firstShape, $secondShape)
{
    if (!in_array($firstShape, SHAPES)) {
        if (!in_array($secondShape, SHAPES)) {
            return 'draw';
        }
        return 'second';
    }
    if (!in_array($secondShape, SHAPES)) {
        return 'first';
    }
    $firstIndex = array_search($firstShape, SHAPES);
    $secondIndex = array_search($secondShape, SHAPES);
    switch ($firstIndex - $secondIndex) {
        case -2:
            return 'first';
        case -1:
            return 'second';
        case 0:
            return 'draw';
        case 1:
            return 'first';
        case 2:
            return 'second';
    }
}

function outputHTML($vars, $template)
{
    $html = file_get_contents($template . '.html');

    echo str_replace(
        array_keys($vars),
        array_values($vars),
        $html
    );
}
