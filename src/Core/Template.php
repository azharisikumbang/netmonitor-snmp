<?php

namespace App\Core;

use App\Entities\User;

class Template implements Contract\TemplateInterface
{
    private string $path;

    private string $templateName;

    public function setTemplatePath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplatePath(): string
    {
        return $this->path;
    }

    public function getTemplate(): string
    {
        return sprintf("%s/%s.php", $this->getTemplatePath(), $this->getTemplateName());
    }

    public function setTemplateName(string $template): self
    {
        $this->templateName = $template;

        return $this;
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    public function setUserTemplateFromConfiguration(User $user, array $roles): void
    {
        foreach ($roles as $role)
            if (strtoupper($user->getRole()) == strtoupper($role['name']))
                $this->setTemplateName($role['template']);
    }
}