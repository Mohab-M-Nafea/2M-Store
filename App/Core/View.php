<?php

class View
{
    public static function load($viewName, $viewData = [])
    {
        $file = VIEWS . $viewName . '.php';

        // echo $file;

        if (!file_exists($file)) {
            $file = VIEWS . 'error.php';
        }

        extract($viewData);

        ob_start();
        require($file);
        ob_flush();
        exit();
    }
}
