<?php

use Task1\PathService;

$map = [
    ['_', '_', '_', '_', '_'],
    ['X', 'X', 'X', 'X', '_'],
    ['_', '_', 'X', '_', '_'],
    ['X', 'X', 'X', '_', 'X'],
    ['_', '_', '_', '_', '_'],
];

$routeService = new PathService();
var_dump($routeService->pathExists($map, [0, 0], [4, 4])); // True
var_dump($routeService->pathExists($map, [0, 0], [2, 1])); // False
