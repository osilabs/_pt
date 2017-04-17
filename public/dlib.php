<?php

function delButton($link, $text) {
    return "[<a href='$link' style='text-decoration:none;' title='$text'><span style='font-weight:bold;color:red;text-effect:none;'>&nbsp;X&nbsp;</span></a>]";
}

function prerender($item) {
    return '<span style="color:#666"><em><strong>' . htmlentities($item) . '</strong></em></span>';
}

function validateName( $name ) {
    $messages = [];

    if (sizeof($name) == 0) {
        $messages[] = "Name was not submitted.";
    }

    if (strlen($name) < 2) {
        $message[] = "Too short: '$name'.";
    }

    if (strlen($name) >= 15) {
        $message[] = "Too long: '$name'.";
    }

    if( 1 === preg_match('/[0-9]/g', $name)) {
        $message[] = "Name may not contain numbers: '$name'.";
    }

    return join(" ", $message) . "/";
};