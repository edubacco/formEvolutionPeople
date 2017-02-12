<?php

define('DBDRIVER',  'mysql');
define('DBHOST', '127.0.0.1');
define('DBDB', 'evolutionp');
define('DBTABLE', 'entries');
define('DBUSER', 'root');
define('DBPSW', 'mysql');
define('DBCHARSET', 'utf8');
define('DBCOLLATION', 'utf8_unicode_ci');
define('DBPREFIX', '');

$columns = [
    'nome' => [
        'label' => 'Nome',
        'type'  => 'string'
    ],
    'cognome' => [
        'label' => 'Cognome',
        'type'  => 'string'
    ],
    'email' => [
        'label' => 'Email',
        'type'  => 'string',
        'attr'  => 'required'
    ],
    'psw' => [
        'label' => 'Password',
        'type'  => 'psw_string',
        'attr'  => 'required'
    ],
    'sesso' => [
        'label' => 'Sesso',
        'type'  => 'radio',
        'values'=> [
            'm'  => 'Uomo',
            'f'  => 'Donna',
        ]
    ],
    'hobby' => [
        'label' => 'Hobby',
        'type'  => 'string'
    ],
];