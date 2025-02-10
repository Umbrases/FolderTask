<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{

    public static function getDeal($dealId)
    {
        return Crest::call('crm.deal.get', [ // Поиск сделки по идентификатору
            'ID' => $dealId
        ])['result'];
    }

    public static function startBizproc($dealId)
    {
        $crmDealId = 'DEAL_' . $dealId;

        return CRest::call('bizproc.workflow.start', [ // Запуск бизнес процесса
            'TEMPLATE_ID' => 246,
            'DOCUMENT_ID' => [
                'crm', 'CCrmDocumentDeal', $crmDealId
            ],
        ]);
    }

    public static function updateDeal($dealId, $contactFolder)
    {
        return Crest::call('crm.deal.update', [ // Обновление поля папки сделки
            'ID' => $dealId,
            'FIELDS' => [
                'UF_CRM_1722838734' => $contactFolder
            ]
        ])['result'];
    }

    public static function checkFolder($dealId)
    {
        $deal = Deal::getDeal($dealId);

        if(!empty($deal['UF_CRM_1722838734'])) {
            $folderName = Folder::getFolderNameFromUrl($deal['UF_CRM_1722838734']);
        } else {
            $folderName = Contact::getContact($deal['CONTACT_ID']);
        }

        return Folder::getFolder(403, $folderName);
    }
}