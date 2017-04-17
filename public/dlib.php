<?php

function delButton($link, $text) {
    return "[<a href='$link' style='text-decoration:none;' title='$text'><span style='font-weight:bold;color:red;text-effect:none;'>&nbsp;X&nbsp;</span></a>]";
}

function prerender($item) {
    return '<span style="color:#666"><em><strong>' . htmlentities($item) . '</strong></em></span>';
}

/**
 * Validate name input
 * @param $name
 * @return string
 */
function validateName( $name ) {
    // Holds error messages
    $messages = [];

    // Check min, max length. Assert no numbers.
    if (empty($name)) {
        $messages[] = "Name was not submitted";
    }
    if (strlen($name) < 3) {
        $messages[] = "Too short: '$name'";
    }
    if (strlen($name) > 15) {
        $messages[] = "Too long: '$name'";
    }
    if( 1 === preg_match('/[0-9]/', $name)) {
        $messages[] = "Name may not contain numbers: '$name'";
    }

    // Return string of messages or empty string if no issues found.
    if (count($messages)) {
        return join(" ", $messages);
    } else {
        return "";
    }
};