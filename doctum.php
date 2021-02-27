<?php

require __DIR__.'/vendor/autoload.php';

use Doctum\Doctum;
use Doctum\RemoteRepository\GitHubRemoteRepository;
use Doctum\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$dir = __DIR__.'/src';

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->exclude('vendor')
    ->in($dir);

$versions = GitVersionCollection::create($dir)
    ->add('1.3', 'v1.3')
    ->add('1.4', 'v1.4')
    ->add('1.5', 'v1.5')
    ->add('1.6', 'v1.6')
    ->add('1.7', 'v1.7')
    ->add('1.8', 'v1.8')
    ->add('2.0', 'v2.0')
    ->add('3.x', 'v3.x')
    ->add('master', 'Master');

$repo = new GitHubRemoteRepository(
    'mtvbrianking/laravel-mtn-momo',
    dirname($dir),
    'https://github.com/'
);

$options = [
    'theme' => 'default',
    'title' => 'Laravel MTN MOMO API',
    'versions' => $versions,
    'build_dir' => __DIR__.'/docs/%version%',
    'cache_dir' => __DIR__.'/docs/cache/%version%',
    'remote_repository' => $repo,
    'default_opened_level' => 2,
];

return new Doctum($iterator, $options);
