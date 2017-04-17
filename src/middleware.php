<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);



$authenticateName = function ( $name = '' ) {
    return function () use ( $name ) {

        if (sizeof($name) <= 2) {
            $message = "Too short";
            $app = \Slim\Slim::getInstance();
            $app->redirect('/namedrop/' . urlencode($message));
            //return $response->withStatus(302)->withHeader('Location', '/namedrop/' . urlencode($message));
        }
    };
};


function validateName($name) {


}