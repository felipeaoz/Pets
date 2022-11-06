<?php
require_once 'php-activerecord/ActiveRecord.php';
date_default_timezone_set('America/Bogota');
 
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('../models');
    $cfg->set_connections(array(
        'development' => 'mysql://root:root@localhost/pets'));
});

?>