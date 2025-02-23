<?php
ini_set('max_execution_time', 0);
set_time_limit(0);

function preprint($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

require "../vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Models\Database;
$db = new Database();

use App\Controllers\DealsController;

DealsController::Deals();
//Task::getTaskUpdate();
//Task::getCheckTask();