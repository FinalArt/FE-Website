<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->view->render($response, 'index.html', $args);
});
