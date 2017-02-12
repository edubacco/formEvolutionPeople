<?php

define('DIRROOT', dirname(__FILE__));

require_once DIRROOT.'/vendor/autoload.php';
require_once DIRROOT.'/settings.php';

//se non ci sono tabelle, le creo
new \App\Db($columns);

//se sto postando, salvo
$saveForm = new \App\SaveForm($columns);
$return = $saveForm->getRet();

//visualizzo il form
require_once DIRROOT.'/frontend/form-page.php';
