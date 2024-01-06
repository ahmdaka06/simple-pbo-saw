<?php
require_once 'vendor/autoload.php';

$_env_repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($_env_repository, __DIR__);
$dotenv->load();

$arr['host'] = [
    'before' => getenv('DB_HOST'),
];

$path = __DIR__ . '/.env';

if (file_exists($path)) {
    file_put_contents(
        $path, 
        str_replace('DB_HOST=' . getenv('DB_HOST'), 'DB_HOST=localhosttttt', file_get_contents($path))
    );
}

putenv('DB_HOST=localhosttttt');

$arr['host']['after'] = getenv('DB_HOST');

print json_encode($arr, JSON_PRETTY_PRINT);
