<?php
session_start();
$title = "Help";

ob_start();
include __DIR__ . "/templates/help.html.php";
$output = ob_get_clean();


include __DIR__ . "/templates/layout.html.php";
