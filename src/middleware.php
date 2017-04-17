<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);



$authenticateName = function ( $request, $response, $args ) {
    return function () use ( $request, $response, $args ) {

        $allPostPutVars = $request->getParsedBody();
        $name = $allPostPutVars['name'];

        if (sizeof($name) <= 2) {
            $message = "Too short";
            return $response->withStatus(302)->withHeader('Location', '/namedrop/' . urlencode($message));
        }
    };
};


function validateName($name) {


}