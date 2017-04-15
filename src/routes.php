<?php
// Routes

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

    $p = new People();
    $p->setName($name);
    $p->save();

//    $response->getBody()->write("Hi '$name'");
//    return $this->renderer->render($response, 'index.phtml', $args);

    return $response->withStatus(302)->withHeader('Location', '/namedrop/');
});

$app->get('/delete/{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');

    $q = new PeopleQuery();
    $person = $q->findPK($id);
    $person->delete();

    return $response->withStatus(302)->withHeader('Location', '/namedrop/');
});

$app->get('/namedrop/', function ($request, $response, $args) {
    $people = PeopleQuery::create()->find();

    $args = [
        'people' => $people
    ];

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
