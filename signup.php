<?php

$title = "Sign Up";

ob_start();
include __DIR__ . "/templates/signup.html.php";
$output = ob_get_clean();


include __DIR__ . "/templates/layout.html.php";
