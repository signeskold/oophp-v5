<!doctype html>
<html lang="sv">
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
<h1>Guess my number</h1>

<h3>Guess a number between 1 and 100. You have <?= $game->tries ?> tries left.</h3>

<form method="post">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<h3><?= $result ?></h3>
</body>
</html>
