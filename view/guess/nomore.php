<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Guess my number</h1>
<p><?= $res ?></p>
<form method="post">
    <input type="submit" name="doInit" value="Play once more">
</form>
