<?php
// Routes








// TODO: make this a general entry point with a link to namedrop
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});





$app->post('/new/', function ($request, $response, $args) {
    $this->logger->info("namedrop '/new' route");

    $allPostPutVars = $request->getParsedBody();
    $name = $allPostPutVars['name'];

    if ( $name == "Damien" ) {
        $message="Nope, can not add Damien.";
    } else {
        $p = new People();
        $p->setName($name);
        $p->save();
        $message="$name has been added";
    }

    //$app = \Slim\Slim::getInstance();
    //$app->flash('Success', 'Name dropped');

    return $response->withStatus(302)->withHeader('Location', '/namedrop/$message');
});






$app->get('/delete/{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');

    $q = new PeopleQuery();
    $person = $q->findPK($id);
    $person->delete();

    return $response->withStatus(302)->withHeader('Location', '/namedrop/');
});






$app->get('/namedrop/[{message}]', function ($request, $response, $args) {
    $people = PeopleQuery::create()
        ->addDescendingOrderByColumn('length(name)')
        ->find();

    $message = $request->getAttribute('message');

    //$app = \Slim\Slim::getInstance();
    //$messages = $app->flash->getMessages();
    //print_r($messages);

    $args = [
        'people' => $people,
        'message' => $message
    ];

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
