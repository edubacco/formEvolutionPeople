<?php
/**
 * Created by PhpStorm.
 * User: e
 * Date: 08/02/17
 * Time: 23.33
 */

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;


class Db
{
    /**
     * @var Capsule
     */
    protected $Capsule;

    /**
     * @var array;
     */
    protected $columns;

    public function __construct($columns = [])
    {
        $this->Capsule = new Capsule();
        $this->columns = $columns;

        $this->Capsule->setAsGlobal();
        $this->makeDb();
    }

    protected function makeDb() {
        $this->Capsule->addConnection([
            'driver'    => DBDRIVER,
            'host'      => DBHOST,
            'database'  => DBDB,
            'username'  => DBUSER,
            'password'  => DBPSW,
            'charset'   => DBCHARSET,
            'collation' => DBCOLLATION,
            'prefix'    => DBPREFIX,
        ]);

        if (!Capsule::schema()->hasTable(DBTABLE)) {
            $this->makeTable();
        }

        $this->Capsule->bootEloquent();
    }

    protected function makeTable() {
        Capsule::schema()->create(DBTABLE, function($table) {
            $table->increments('id');
            $table->timestamps();
            foreach ($this->columns as $col_key => $col_det) {
                switch ($col_det['type']) {
                    case 'string_unique':
                        $table->string($col_key)->unique();
                        break;

                    default:
                        $table->string($col_key);
                        break;
                }
            }
        });
    }
}