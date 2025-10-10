<?php 
namespace App\Libraries;

use App\Services\FormTypeService;

abstract class BaseForm
{
    protected $db;
    protected $table;

    private $columns = [
        'name',
        'type',
        'placeholder',
        'required',
        'form_group',
        'attributes',
        'label',
        'isLabel',
        'option_values',
        'provide_table',
        'provide_field',
        'provide_key',
        'provide_cond',
        'is_read_only',
        'legend'
    ];

    public function __construct() {
        $this->db = db_connect();
    }

    public function getColumns(?string $table = null) : array {
        return array_map(fn($key) => $table. "." . $key, $this->columns ?? []);
    }

    public function builder(array $params = [], array $items = [], array $overrides = []) : array {
        $requestedFields = [];

        foreach ($params as $key => $field) {
            $field['type']          = FormTypeService::getTypeByName($field['type']);
            $field['attributes']    = json_decode($field['attributes'], true);
            $field['isLabel']       = filter_var($field['isLabel'], FILTER_VALIDATE_BOOLEAN);
            $field['required']      = filter_var($field['required'], FILTER_VALIDATE_BOOLEAN);
            $field['is_read_only']  = filter_var($field['is_read_only'], FILTER_VALIDATE_BOOLEAN);
            $field['option_values'] = $this->selectOptions($field, $items);

            if (isset($overrides[$field['name']]) && is_array($overrides[$field['name']])) {
                $field = array_merge($field, $overrides[$field['name']]);
            }
            $requestedFields[$key] = $field;
        }
        return $requestedFields;
    }

    protected function selectOptions($field, $items) {
        $type = $field['option_values'] ?? null;
        if (empty($type) || $type === null) return;

        switch ($type) {
            case 'value':
                # code...
                break;
            
            default: throw new \Exception(lang('Message.forms.failed.option_values'));
        }
    }
}