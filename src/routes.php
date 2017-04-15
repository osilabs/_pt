<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/namedrop/[{name}]', function ($request, $response, $args) {
    $this->logger->info("namedrop '/namedrop' route");
    return $this->renderer->render($response, 'namedrop.phtml', $args);
});
