<?php 
namespace App\Libraries;

use App\Libraries\FormStatic;

class FormCustomize
{
    protected static ?FormStatic $static = null;
    protected static array $items = [];
    
    protected static function init() : void {
        if (self::$static === null) {
            self::$static = new FormStatic();
        }
    }

    public static function setItems($items) : void {
        self::$items = $items;
    }

    public static function render(string $type = 'static') {
        self::init();
        
        return match ($type) {
            'static'    => self::$static->render(self::$items),
            default     => throw new \InvalidArgumentException(lang('Message.forms.failed.type', [
                'type' => $type
            ]))
        };
    }
}