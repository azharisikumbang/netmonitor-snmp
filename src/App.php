<?php

namespace App;

use App\Core\Contract\ManagerInterface;

/**
 * Application is ...
 */
final class App
{
    /**
     * Summary of config
     * @var array
     */
    private array $config = [];
    /**
     * Summary of manager
     * @var 
     */
    private ?ManagerInterface $manager;

    /**
     * Summary of __construct
     * @param \App\Core\Contract\ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Summary of getManager
     * @return \App\Core\Contract\ManagerInterface
     */
    public function getManager(): ManagerInterface
    {
        return $this->manager;
    }

    /**
     * Summary of setTimeZone
     * @param string $zone
     * @return void
     */
    public function setTimeZone(string $zone): void
    {
        date_default_timezone_set($zone);
    }

    /**
     * Summary of setEnvironment
     * @param string $env
     * @return \App\App
     */
    public function setEnvironment(string $env = "development"): self
    {
        $env = strtolower($env ?? $this->getConfigFrom('app', 'env'));

        if ($env == 'prod' || $env == 'production' || $env == 'prods') {
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ERROR | E_WARNING | E_PARSE);

            return $this;
        }

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('error_reporting', E_ALL);

        return $this;
    }

    /**
     * Summary of run
     * @return void
     */
    public function run(): void
    {
        $this->getManager()->getRouter()->build();
        $this->getManager()->getTemplate()->setTemplateName('public');

        /** @var \App\Entities\User $user */
        $user = $this->getManager()->getSession()->get('authenticated');
        if ($user) {
            $roles = $this->getManager()->getConfiguration()->get('app', 'roles');
            $this->getManager()->getTemplate()->setUserTemplateFromConfiguration($user, $roles);
        }

        $template = $this->getManager()->getTemplate()->getTemplate();
        $content = $this->getManager()->getRouter()->getContent();

        $this->getManager()->getResponse()->render(
            $template, $content
        );

        $this->getManager()->getSession()->remove('temp');
    }
}