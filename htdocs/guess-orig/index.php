<?php
/**
* Show off the autoloader.
*/
require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";

session_name("sisl19");
session_start();

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
}

$guess   = $_POST["guess"] ?? null;
$doInit  = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$result = "";

$game = $_SESSION["game"];

if ($doInit || $game->number === null) {
    $game = new Guess();
    $game->random();
    $_SESSION["game"] = $game;
} elseif ($doGuess && $game->tries > 0) {
    $result = $game->makeGuess($guess);
} elseif ($doCheat) {
    $result = "The secret number is ".$game->number();
}

require __DIR__ . "/view/guess_post.php";
