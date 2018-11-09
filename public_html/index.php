<?php

define('SHAPES', ['R', 'P', 'S']);
define('PLAYER_INDEX_FILE', 'player-index.txt');
define('GAMES_FILE', 'games.txt');

require_once 'functions.php';

// 1
session_start();

// 2
if (empty($_SESSION)) { //1  Массива сессии нет поэтому заходим в условие  //30 $_SESSION существует, поэтому в условие не попадаем
    //50 Массива сессии второго игрока нет поэтому заходим в условие
    $playerIndex = file_exists(PLAYER_INDEX_FILE) //2  в $playerIndex записывается 0, т.к. PLAYER_INDEX_FILE не существует
    ? file_get_contents(PLAYER_INDEX_FILE)   //51   в $playerIndex записывается 1 cм.6
    : 0;


    echo '$playerIndex = ';                  /////////////////
    echo $playerIndex;                       /////////////////
    echo '<br />';                           /////////////////


    $playerIndex++;


    echo '$playerIndex = ';                  ////////////////
    echo $playerIndex;                       /////////////////
    echo '<br />';                           /////////////////


    $_SESSION['username'] = 'Player' . $playerIndex;


    echo '$_SESSION[username] = ';           /////////////////
    echo $_SESSION['username'];              /////////////////
    echo '<br />';                           /////////////////


    $_SESSION['game'] = false;

    echo '$_SESSION[game] = ';               /////////////////
    echo $_SESSION['game'];                  /////////////////
    echo '<br />';                           /////////////////


    file_put_contents(PLAYER_INDEX_FILE, $playerIndex);
}

if (isset($_GET['new'])) {
    $_SESSION['game'] = false;
}

// 3
$username = $_SESSION['username'];

echo '$username = ';                         /////////////////
echo $username;                              /////////////////
echo '<br />';                               /////////////////


$shape = $_REQUEST['shape'] ?? false;

echo '$shape = ';                            /////////////////
echo $shape;                                 /////////////////
echo '<br />';                               /////////////////

echo '[$_SESSION[game]] = ';                 /////////////////
var_dump($_SESSION['game']);                 /////////////////
echo '<br />';                               /////////////////


if ($_SESSION['game'] !== false) {
    $gameData = getAllGamesData()[$_SESSION['game']];

    echo '$gameData = ';                     /////////////////
    var_dump($gameData);                     /////////////////
    echo '<br />';                           /////////////////

} else {
    $gameData = getGameData();

    echo '$gameData = ';                     /////////////////
    var_dump($gameData);                     /////////////////
    echo '<br />';                           /////////////////

}

// 4
echo '$shape = ';                            /////////////////
echo $shape;                                 /////////////////
echo '<br />';                               /////////////////

if ($shape) {
    if (isset($gameData[$username])) {
        # it is him game
    } elseif ($_SESSION['game'] === false) {

        echo '$_SESSION[game] = ';           /////////////////
        echo $_SESSION['game'];              /////////////////
        echo '<br />';                       /////////////////


        $gameData[$username] = $shape;

        echo '$gameData[$username] = ';      /////////////////
        var_dump($gameData[$username]);      /////////////////
        echo '<br />';                       /////////////////

        $_SESSION['game'] = saveGameData($gameData);

        echo '$_SESSION[game] = ';           /////////////////
        echo $_SESSION['game'];              /////////////////
        echo '<br />';                       /////////////////
    }
}

$vars = [
    '{USERNAME}' => $_SESSION['username']
];

echo '$vars = ';                             /////////////////
var_dump($vars);                             /////////////////
echo '<br />';                               /////////////////


echo 'count($gameData) = ';                  /////////////////
$c = count($gameData);                       /////////////////
echo $c;                                     /////////////////
echo '<br />';                               /////////////////


if (count($gameData) === 0) {
    outputHTML($vars, 'forms');
} elseif (count($gameData) === 1) {
    if (isset($gameData[$_SESSION['username']])) {
        outputHTML($vars, 'waiting');
    } else {
        outputHTML($vars, 'forms');
    }
} else {
    $shapes = [];
    $players = [];
    foreach ($gameData as $player => $shape) {
        $shapes[] = $shape;
        $players[] = $player;
    }

    $results = playRockPaperScissors($shapes[0], $shapes[1]);

    if ($results === 'first') {
        $results = $players[0] . ' win';
    } elseif ($results === 'second') {
        $results = $players[1] . ' win';
    } else {
        $results = 'Draw';
    }
    
  //  $gameData[] = $results;
//    var_dump($gameData);
       
    $vars['{RESULTS}'] = $results;
    outputHTML($vars, 'results');
}

