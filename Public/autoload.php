<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__) . DS);
define('APP', ROOT . 'App' . DS);
define('CORE', APP . 'Core' . DS);
define('CONTROLLERS', APP . 'Controllers' . DS);
define('MODELS', APP . 'Models' . DS);
define('VIEWS', APP . 'Views' . DS);
define('CONFIG', APP . 'Config' . DS);
define('UPLOADS', ROOT . 'Public' . DS . 'Uploads' . DS);

require CONFIG . 'config.php';
require CONFIG . 'helper.php';

$modules = [ROOT, APP, CORE, CONTROLLERS, MODELS, VIEWS, CONFIG];
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));

spl_autoload_register();