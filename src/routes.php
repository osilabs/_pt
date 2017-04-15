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
    foreach($people as $person) {
        $response->getBody()->write("> Hello, " . $person->getName());
    }

    $args = ['people' => $people];

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
