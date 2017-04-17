<?php

function delButton($link, $text) {
    return "[<a href='$link' title='$text'><span style='color:red; text-decoration:none; text-effect:none;'>&nbsp;x&nbsp;</span></a>]";
}

function prerender($item) {
    return '<span style="color:#666"><em><strong>' . htmlentities($item) . '</strong></em></span>';
}

function validateName( $request, $response) {
    $allPostPutVars = $request->getParsedBody();
    $name = $allPostPutVars['name'];

    if (sizeof($name) <= 5) {
        $message = "Too short";
        return $response->withStatus(302)->withHeader('Location', '/namedrop/' . urlencode($message));
    }
};