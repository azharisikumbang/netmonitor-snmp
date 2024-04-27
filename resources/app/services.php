<?php

use App\Repositories\UserRepository;
use App\Services\AuthenticatorService;
use Psr\Container\ContainerInterface;

return [
    AuthenticatorService::class => DI\create()->constructor(DI\get(UserRepository::class)),
    UserRepository::class => fn() => new UserRepository()
];