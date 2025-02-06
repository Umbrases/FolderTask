<?php

namespace App\controllers;

use App\models\Deal;
use App\Models\Task;

class DealsController
{
    public static function Deals()
    {
        $dealId = Task::getTaskId();
        preprint($dealId);

        start:  // Метка
        $deal = Deal::getDeal($dealId);

        $folder = Deal::checkFolder($deal);

        if (empty($folder)) {
            Deal::startBizproc($dealId);
            goto start; // Вернуться к метка
        }

    }
}