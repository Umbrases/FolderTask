<?php

namespace App\controllers;

use App\models\Deal;
use App\Models\Folder;
use App\Models\Task;

class DealsController
{
    public static function Deals()
    {
        $dealIds = Task::getTaskId();

        foreach ($dealIds as $key => $dealId) {
            $search = Folder::where('task_data_id', $dealId->id)->get();

            if (empty($search[0]->id)) {
                $folder = Deal::checkFolder($dealId->uf_crm_id);

                if (empty($folder)) {
                    Deal::startBizproc($dealId->uf_crm_id);

                    sleep(2);

                    $folder = Deal::checkFolder($dealId->uf_crm_id);
                }
//                preprint($folder);

                if (!empty($folder)) {
                    Folder::taskFolderAdd($folder['ID'], $dealId);
                }
            }
        }
    }
}