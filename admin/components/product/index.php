<?php

switch ($act) {
    case 'man':
        $template = 'man';
        get_mans();
    break;

    case 'add':
        $template = 'add';
        break;

    case 'edit':
        $template = 'add';
        break;

    default:
        # code...
        break;
}


function get_mans() {
}

?>
