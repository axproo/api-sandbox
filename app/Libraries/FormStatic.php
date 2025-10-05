<?php 
namespace App\Libraries;

class FormStatic extends BaseForm
{
    public static ?string $url = '/';

    public function render(array $items = [], array $overrides = []) {
        
        if (!$this->db->tableExists('form_static')) {
            return throw new \Exception(lang('Message.tables.failed.exist', [
                'table' => 'form_static'
            ]));
        }

        $query = $this->db->table('form_static')->select($this->getColumns('form_static'));
        foreach (array_keys($items) as $key) {
            $query->orWhere('name', $key);
        }

        $result = $query->orderBy('sort_order', 'ASC')->get()->getResultArray();
        $fields = $this->builder($result, $items, $overrides);

        if (!$fields) {
            return throw new \Exception(lang('Message.forms.failed.field', [
                'form' => 'form_static'
            ]));
        }

        return apiResponse(200, lang('Message.forms.type.static'), [
            'url'       => self::$url,
            'path_url'  => uri_string(),
            'dataForm'  => $items,
            'fieldData' => $fields
        ]);
    }
}