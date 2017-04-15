<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/new/{name}', function ($request, $response, $args) {
    $this->logger->info("namedrop '/new' route");

    $name = $request->getAttribute('name');
    $p = new People();
    $p->setName($name);
    $p->save();

    return $response->withStatus(302)->withHeader('Location', '/namedrop/');
});

$new_path = $app->router->pathFor('new');

$app->get('/namedrop/', function ($request, $response, $args) {
    $people = PeopleQuery::create()->find();
//    $new_url = $router->pathFor('new');

    $args = [
        'people' => $people
        //,
        //'new_route' => $new_url
    ];

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
