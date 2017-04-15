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

//    $name = $request->getAttribute('name');
//    $response->getBody()->write("> Hello, $name");

    $p = new People();
    $p->setName($name);
    $p->save();

    return $response->withStatus(302)->withHeader('Location', '/namedrop/');

#    return $this->renderer->render($response, 'namedrop.phtml', $args);
});

$app->get('/namedrop/[{name}]', function ($request, $response, $args) {
    $this->logger->info("namedrop '/namedrop' route");

    $name = $request->getAttribute('name');

    $response->getBody()->write("TEST OUTS");

    $people = PeopleQuery::create()->find();
    $response->getBody()->write(print_r($people));

    foreach($people as $person) {
        $response->getBody()->write("> Hello, " . $person->getName());
    }

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
