<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Initiate the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Initiate the game
    $game = new Sisl\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
    $_SESSION["found"] = $game->found();
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    return $app->response->redirect("guess/play");
});

/**
 * Play the game.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $guess ?? null,
        "doCheat" => $doCheat ?? null
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("guess/play", function () use ($app) {

    $guess = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $found = $_SESSION["found"] ?? null;
    $game = new Sisl\Guess\Guess($number, $tries, $found);

    if ($doInit || $game->number === null) {
        $game = new Sisl\Guess\Guess();
        $game->random();
        $_SESSION["tries"] = $game->tries();
        $_SESSION["number"] = $game->number();
    } elseif ($doGuess) {
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["found"] = $game->found();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
        if ($_SESSION["tries"] == 0 || $_SESSION["found"] == 1) {
            return $app->response->redirect("guess/nomore");
        }
    } elseif ($doCheat) {
        $res = "The secret number is ".$game->number();
        $_SESSION["res"] = $res;
    }

    return $app->response->redirect("guess/play");
});

$app->router->get("guess/nomore", function () use ($app) {
    $res = $_SESSION["res"] ?? null;
    $data = [
        "number" => $number ?? null,
        "res" => $res
    ];
    $app->page->add("guess/nomore", $data);
    $title = "End of game";
    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("guess/nomore", function () use ($app) {
    return $app->response->redirect("guess/init");
});
