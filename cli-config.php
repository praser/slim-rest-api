<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$settings = require( __DIR__ . '/src/settings.php');
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Models/Entity"), true);
$entityManager = EntityManager::create($settings['settings']['db'], $config);

return ConsoleRunner::createHelperSet($entityManager);