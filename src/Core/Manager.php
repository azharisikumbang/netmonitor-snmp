<?php

namespace App\Core;

use App\Core\Contract\ConfigurationInterface;
use App\Core\Contract\DatabaseInterface;
use App\Core\Contract\ManagerInterface;
use App\Core\Contract\RequestInterface;
use App\Core\Contract\ResponseInterface;
use App\Core\Contract\RouterInterface;
use App\Core\Contract\SessionInterface;
use App\Core\Contract\TemplateInterface;

/**
 * Summary of Manager
 */
class Manager implements ManagerInterface
{
    private DatabaseInterface $database;

    private ConfigurationInterface $configuration;

    private RequestInterface $request;

    private ResponseInterface $response;

    private SessionInterface $session;

    private TemplateInterface $template;

    private RouterInterface $router;

    /**
     * @return DatabaseInterface
     */
    public function getDatabase(): DatabaseInterface
    {
        return $this->database;
    }

    /**
     * @param DatabaseInterface $database
     */
    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }

    /**
     * @return ConfigurationInterface
     */
    public function getConfiguration(): ConfigurationInterface
    {
        return $this->configuration;
    }

    /**
     * @param ConfigurationInterface $configuration
     */
    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->configuration = $configuration;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->getRouter()->getRequest();
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }

    /**
     * @param TemplateInterface $template
     */
    public function setTemplate(TemplateInterface $template): void
    {
        $this->template = $template;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }
}