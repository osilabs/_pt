<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/namedrop/welcome/{name}/[{lname}]', function ($request, $response, $args) {
    $this->logger->info("namedrop '/namedrop' route");

    $name = $request->getAttribute('name');
    $response->getBody()->write("> Hello, $name");

#    $author = new People();
#    $author->setName($name);
#    $author->save();

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
