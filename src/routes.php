<?php

// Homepage of the website
$app->get('/', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->view->render($response, 'index.html', [
        "navbarCurrentItem" => "index"
    ]);
});

// Pokedex containing all pokemon showable
$app->get('/pokedex', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");

    $fileName = __DIR__ . '/../data/pokemons.json';
    $pokemons = [];
    if (file_exists($fileName)) {
        $json = file_get_contents($fileName);
        $pokemons = json_decode($json, true);
    }

    return $this->view->render($response, "pokedex.html", [
        "navbarCurrentItem" => "pokedex",
        "pokemons" => $pokemons
    ]);
});
