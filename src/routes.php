<?php
//
// Routes
//


/**
 * Landing page
 */
$app->get('/', function ($request, $response, $args) {
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

/**
 * Primary Interface. Interact with system.
 */
$app->get('/namedrop/[{message}/]', function ($request, $response, $args) {
    $people = PeopleQuery::create()
        ->addDescendingOrderByColumn('length(name)')
        ->find();

    $message = $request->getAttribute('message');

    $args = [
        'people' => $people,
        'message' => $message
    ];

    return $this->renderer->render($response, 'namedrop.phtml', $args);
});

/**
 * Create new users
 */
$app->post('/new/', function ($request, $response, $args) {
    $this->logger->info("namedrop '/new' route");

    // Get new value to add
    $allPostPutVars = $request->getParsedBody();
    $name = $allPostPutVars['name'];

    // Validate input
    if ($message = (validateName($name))) {
        return $response->withStatus(302)->withHeader('Location', '/namedrop/' . urlencode($message) . "/");
    } else {
        // Save to db
        $p = new People();
        $p->setName($name);
        $p->save();
        $message = "$name has been added";

        return $response->withStatus(302)->withHeader('Location', '/namedrop/' . urlencode($message) . "/");
    }
});

/**
 * Delete a user
 */
$app->get('/delete/{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');

    $q = new PeopleQuery();
    $person = $q->findPK($id);
    $person->delete();

    return $response->withStatus(302)->withHeader('Location', '/namedrop/');
});
