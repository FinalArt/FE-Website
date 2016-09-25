<?php

// DIC configuration
$container = $app->getContainer();

// View renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));
    $view->getEnvironment()->addFunction(new Twig_SimpleFunction('translate', ['Helpers\Translator', 'translate']));
    return $view;
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

/**
     * Associate a pokemon type to a Semantic-UI color
     *
     * @param $type The type of the Pokemon
     * @return string The name of the related color
     */
/*public function typeToColor($type) {
    $color = "";
    switch ($type) {
        case "Normal" :
            $color = "grey";
            break;
        case "Fire" :
            $color = "red";
            break;
        case "Water" :
            $color = "blue";
            break;
        case "Electric" :
            $color = "yellow";
            break;
        case "Grass" :
            $color = "green";
            break;
        case "Ice" :
            $color = "teal";
            break;
        case "Fighting" :
            $color = "orange";
            break;
        case "Poison" :
            $color = "purple";
            break;
        case "Ground" :
            $color = "brown";
            break;
        case "Flying" :
            $color = ""; // Use the basic "grey" color
            break;
        case "Psychic" :
            $color = "purple";
            break;
        case "Bug" :
            $color = "olive";
            break;
        case "Rock" :
            $color = "brown";
            break;
        case "Ghost" :
            $color = "black";
            break;
        case "Dragon" :
            $color = "violet";
            break;
        case "Dark" :
            $color = "black";
            break;
        case "Steel" :
            $color = ""; // Use the basic "grey" color
            break;
        case "Fairy" :
            $color = "pink";
            break;
        default :
            break;
    }
    return $color;
}*/