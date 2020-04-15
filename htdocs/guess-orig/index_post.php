<?php
/**
* Get incoming values from posted form.
*/
$number  = $_POST["number"] ?? null;
$tries   = $_POST["tries"]  ?? null;
$guess   = $_POST["guess"]  ?? null;
$doInit  = $_POST["doInit"]  ?? null;
$doGuess = $_POST["doGuess"]  ?? null;
$doCheat = $_POST["doCheat"]  ?? null;

$redirect = $_POST["redirect"] ?? "?page=index";
header("Location: $redirect");
