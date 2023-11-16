<?php
namespace App\Helpers;

class Apphelper
{

    public static function Appseotitle($inputString)
    {
        $cleanedString = preg_replace('/[^\p{L}\d]+/u', '-', $inputString);
        $cleanedString = trim($cleanedString, '-');
        $cleanedString = str_replace(' ', '-', $cleanedString);
        $seoTitle = strtolower($cleanedString);
        return $seoTitle;
    }

    public function Major($param)
    {
        switch ($param) {
            case '1':
                return 'TK A';
                break;
            case '2':
                return 'TK B';
                break;
            case '3':
                return 'SD';
                break;
            case '3':
                return 'MTS';
                break;
            default:
                return 'Undefined';
                break;
        }
    }

}
