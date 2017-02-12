<?php
/**
 * Created by PhpStorm.
 * User: e
 * Date: 12/02/17
 * Time: 17.01
 */

namespace App;
use App\Entry;


class SaveForm
{

    protected $fields;

    protected $raw_data;
    protected $data;

    /**
     * @var array key => error_msg
     */
    protected $errors;

    protected $ret = false;

    public function __construct(array $columns)
    {
        if (!(isset($_REQUEST['sending_form']) && $_REQUEST['sending_form'] == 1)) {
            return;
        }

        $this->fields = array_keys($columns);

        $this->read_data();
        $this->clean_data();
        $this->ret = $this->save_to_db();
    }

    public function getRet()
    {
        return $this->ret;
    }

    protected function read_data() {
        foreach ($this->fields as $field) {
            $this->raw_data[$field] = $_REQUEST[$field];
        }
    }

    protected function clean_data() {
        foreach ($this->raw_data as $key => $raw_data) {
            switch ($key) {
                case 'email':
                    $data = filter_var($raw_data, FILTER_VALIDATE_EMAIL);
                    if (false === $data) {
                        $this->errors[$key] = 'Email non valida';
                    } else {
                        $this->data[$key] = $data;
                    }
                    break;

                case 'psw':
                    if ($raw_data !== $_REQUEST['psw_repeat']) { //todo: ma qualcosa di meglio no?
                        $this->errors[$key] = 'Le password non coincidono';
                    } else {
                        $this->data[$key] = md5($raw_data);
                    }
                    break;

                default:
                    $data = filter_var($raw_data, FILTER_SANITIZE_STRING);

                    if (false === $data) {
                        $this->errors[$key] = 'Input non valido';
                    } else {
                        $this->data[$key] = $data;
                    }
                    break;

            }
        }
    }

    protected function save_to_db() {
        $ret = [];

        if (isset($this->errors) || !empty($this->errors)) {
            $ret['errors'] = $this->errors;
            $ret['data'] = $this->data;

            return $ret;
        }

        $entry = new Entry($this->data, $this->fields);
        if ($entry->save()){
            $ret['msg'] = 'Dati inseriti';
        } else {
            $ret['errors'][] = 'Errore durante l\'inserimento dei dati';
        }

        return $ret;
    }
}