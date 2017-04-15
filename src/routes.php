<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->put('/new/{name}', function ($request, $response, $args) {
    $this->logger->info("namedrop '/new' route");

    $name = $request->getAttribute('name');
    $response->getBody()->write("> Hello, $name");

    $p = new People();
    $p->setName($name);
    $p->save();

    $app->flash('error', $e->getMessage());
    $app->redirect('/namedrop');

#    return $this->renderer->render($response, 'namedrop.phtml', $args);
});

$app->get('/namedrop/[{name}]', function ($request, $response, $args) {
    $this->logger->info("namedrop '/namedrop' route");

    $name = $request->getAttribute('name');
    $response->getBody()->write("> Hello, $name");

    $people = PeopleQuery::create()->find();
    foreach($person as $people) {
        echo $person->getFirstName();
    }

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
