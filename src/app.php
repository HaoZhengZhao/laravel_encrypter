<?php

use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Application;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv('APP_ENV');
$dotenv->usePutenv();
$dotenv->load(__DIR__ . '/../.env');

$application = new Application('sorry510', '0.0.1');
$finder = new Finder();

$files = $finder->files()->name('*.php')->in(__DIR__ . '/Command');

/** @var SplFileInfo $file */
foreach ($files as $file) {
    $className = "\\App\\Command\\" . substr($file->getFilename(), 0, -4);
    if (class_exists($className)) {
        $application->add(new $className);
    }
}

$application->run();