<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    public static function getContact($contactId)
    {
        $contact = Crest::call('crm.contact.get', [
            'ID' => $contactId
        ])['result'];

        if (empty($contact['UF_CRM_1722586545'])) {
            $folderName = Folder::getFolderName($contact);
        } else {
            $folderName = Folder::getFolderNameFromUrl($contact['UF_CRM_1722586545']);
        }

        return $folderName;
    }


}