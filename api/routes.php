<?php

// Homepage of the website
$app->get('/', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->view->render($response, 'index.html', [
        "lang" => Helpers\Translator::DEFAULT_LANG
    ]);
});

// Homepage of the website with a specific language
$app->get('/{lang}', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->view->render($response, 'index.html', [
        "lang" => Helpers\Translator::check($request->getAttribute("lang"))
    ]);
});

// Pokedex containing all pokemon showable
$app->get('/api/pokedex', function ($request, $response, $args) {
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
