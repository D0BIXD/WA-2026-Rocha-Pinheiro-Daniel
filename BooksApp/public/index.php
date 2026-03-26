<?php

// Pro účely výuky 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//načtění třídy routeru, která se postará o zpracování URL
require_once '../core/App.php';

$app = new App();