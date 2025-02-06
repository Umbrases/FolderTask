<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{

    public static function getFolder($folderId, $nameFolder)
    {
        //$folderId = 403 - Папка Kliyenty. Bankrotstvo
        return Crest::call('disk.folder.getchildren', [ // Поиск папки
            'id' => $folderId, //Идентификатор папки
            'filter' => [
                'NAME' => $nameFolder //Имя папки
            ]
        ])['result'];
    }

    public static function addFolder($folderId, $nameFolder)
    {
        return Crest::call('disk.folder.addsubfolder', [ //Создание папки
            'id' => $folderId, //Идентификатор папки
            'data' => [
                'NAME' => $nameFolder //Имя папки
            ]
        ]);
    }

    public static function getFolderName($contact)
    {
        if (empty($contact['NAME'])) { // Если нет имени контакта
            empty($contact['LAST_NAME']) ? $folderName = 'Contact ' . $contact['ID'] : // Если нет фамилии контакта
                $folderName = 'Contact ' . $contact['ID'] . ' (' . $contact['LAST_NAME'] . ')'; // Если есть фамилия контакта
        } else { // Если есть имя контакта
            empty($contact['LAST_NAME']) ? $folderName = 'Contact ' . $contact['ID'] . ' (' . $contact['NAME'] . ')' : // Если нет фамилии контакта
                $folderName = 'Contact ' . $contact['ID'] . ' (' . $contact['NAME'] . ' ' . $contact['LAST_NAME'] . ')'; // Если есть фамилия контакта
        }

        return $folderName;
    }

    public static function getFolderNameFromUrl($str)
    {
        $folderUrl = explode('/', $str);

        foreach ($folderUrl as $folder) {
            if (str_contains($folder, 'Contact')) return $folder;
        }
    }
}