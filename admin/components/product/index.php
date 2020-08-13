<?php

switch ($act) {
    case 'man':
    case 'edit':
        $template = 'add';
        break;

    default:
        # code...
        break;
}

var_dump($template);

?>
