<?php
function url($url = '')
{
    echo MAIN_URL . $url;
}

function redirect($url = '')
{
    $url = MAIN_URL . $url;
    header('Location:' . $url);
    exit();
}
