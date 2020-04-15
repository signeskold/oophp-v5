<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


$try = ($tries==1) ? "try" : "tries";
?><h1>Guess my number</h1>
<p>Guess a number between 1 and 100. You have <?= $tries ?> <?= $try ?> left.</p>

<form method="post">
    <input type="number" name="guess" required='required'>
    <input type="submit" name="doGuess" value="Make a guess">
</form>
<?php if ($res) : ?>
    <p><?= $res ?></p>
<?php endif; ?><br>
<form method="post">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>
