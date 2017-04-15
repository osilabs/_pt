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


$app->get('/namedrop/', function ($request, $response, $args) {
    $people = PeopleQuery::create()->find();

    $args = [
        'people' => $people,
        'del_route' => $app->urlFor('new', array('name' => 'Dynamimi'))
    ];

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
