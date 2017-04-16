<?php

function delButton($link, $text) {
    return "[<a href='$link' title='$text'><span style='color:red; text-decoration:none; text-effect:none;'>&nbsp;x&nbsp;</span></a>]";
}

function prerender($item) {
    return '<span style="color:#666"><em><strong>' . htmlentities($item) . '</strong></em></span>';
}