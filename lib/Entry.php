<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model {

    public function __construct(array $attributes, $db_columns)
    {
        $this->fillable = $db_columns;
        parent::__construct($attributes);
    }

}