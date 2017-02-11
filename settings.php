<?php

define('DBDRIVER',  'mysql');
define('DBHOST', '127.0.0.1');
define('DBDB', 'evolutionp');
define('DBTABLE', 'form_fields');
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
        'type'  => 'string_unique'
    ],
    'psw' => [
        'label' => 'Password',
        'type'  => 'string'
    ],
    'sesso' => [
        'label' => 'Sesso',
        'type'  => 'string'
    ],
    'hobby' => [
        'label' => 'Hobby',
        'type'  => 'string'
    ],
];