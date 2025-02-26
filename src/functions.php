<?php

use App\App;

/** @var $app \App\App */

if (!function_exists('app'))
{
    function app(): App
    {
        if (!isset($app))
        {
            global $app;

            if (is_null($app))
                $app = new App();
        }

        return $app;
    }
}

if (!function_exists('config'))
{
    function config(string $container, string $name): mixed
    {
        $app = app();

        return $app->getManager()->getConfiguration()->get($container, $name);
    }
}

if (!function_exists('base_path'))
{
    function base_path(): string
    {
        return __DIR__ . "/Projects/";
    }
}

if (!function_exists('site_url'))
{
    function site_url(string $url = ""): string
    {
        $siteUrl = rtrim(config('app', 'site_url'), "/");

        return $url ? sprintf("%s/%s", $siteUrl, $url) : $siteUrl;
    }
}

if (!function_exists('public_url'))
{
    function public_url(): string
    {
        return config('app', 'site_url');
    }
}

if (!function_exists('assets'))
{
    function assets(string $url): string
    {
        return site_url('assets/' . $url);
    }
}

if (!(function_exists('get_current_route')))
{
    function get_current_route(bool $full = false): string
    {
        $router = app()->getManager()->getRouter();

        return $full ? site_url($router->getPath()) : rtrim($router->getPath(), "/");
    }
}

if (!function_exists('session'))
{
    function session(?string $key = null): mixed
    {
        /** @var \App\Core\Session $sessionManager  */
        $sessionManager = app()->getManager()->getSession();

        if (is_null($key))
            return $sessionManager;

        return $sessionManager->exists($key) ? $sessionManager->get($key) : null;
    }
}

if (!function_exists('response'))
{
    function response(): \App\Core\Response
    {
        return app()->getManager()->getResponse();
    }
}

if (!function_exists('request'))
{
    function request(): \App\Core\Request
    {
        return app()->getManager()->getRequest();
    }
}

if (!function_exists('tanggal'))
{
    function tanggal(DateTimeInterface $date, bool $month = true, bool $full = false)
    {
        $format = $full ? "d/m/Y H:i:s" : "Y/m/d";
        $today = $date->format($format);
        if ($month)
        {
            $listMonth = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            $exploded = explode("/", $today);

            return sprintf("%s %s %s", $exploded[2], $listMonth[$exploded[1] - 1], $exploded[0]);
        }

        return $today;
    }
}

if (!(function_exists('rupiah')))
{
    function rupiah(float $number, string $tanda = ".")
    {
        return number_format($number, 0, ",", $tanda);
    }
}

if (!(function_exists('html_active_menu')))
{
    function html_active_menu(string $route): string
    {
        return (strtolower(get_current_route()) == $route)
            ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize'
            : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize';
    }
}

if (!(function_exists('html_require_component')))
{
    function html_require_component(string $name, mixed $data = null): void
    {
        require_once __DIR__ . '/templates/components/' . $name . '.php';
    }
}

if (!(function_exists('html_alert')))
{
    function html_alert(string $message, string $color = 'red'): void
    {
        require __DIR__ . '/templates/components/alert.php';
    }
}

if (!(function_exists('html_temp_alert')))
{
    function html_temp_alert(string $message, string $color = 'red'): void
    {
        require __DIR__ . '/templates/components/temp_alert.php';
    }
}

if (!(function_exists('html_not_found')))
{
    function html_not_found(string $message = 'Tidak Ditemukan.'): void
    {
        http_response_code(404);
        require __DIR__ . '/../frontend/pages/static/404.php';
        exit();
    }
}

if (!(function_exists('html_unauthorized')))
{
    function html_unauthorized(string $message = 'Tidak Ditemukan.'): void
    {
        http_response_code(403);
        require __DIR__ . '/../frontend/pages/static/403.php';
        exit();
    }
}

if (!(function_exists('html_server_error')))
{
    function html_server_error(string $message = 'Server bersamalah, mohon hubungi administrator.'): void
    {
        http_response_code(500);
        require __DIR__ . '/../frontend/pages/static/500.php';
        exit();
    }
}

if (!(function_exists('html_form_errors')))
{
    function html_form_errors(array $errors): void
    {
        foreach ($errors as $error):
            require __DIR__ . '/../frontend/components/form-warning-alert.php';
        endforeach;
    }
}

if (!(function_exists('html_form_success')))
{
    function html_form_success(string $message): void
    {
        require __DIR__ . '/../frontend/components/form-success-alert.php';
    }
}


if (!(function_exists('html_load_component')))
{
    function html_load_component(string $name, array $data): void
    {
        require __DIR__ . sprintf("/../frontend/components/%s.php", $name);
    }
}

if (!(function_exists('load_externals')))
{
    function load_externals(callable $callback): void
    {
        $callback(__DIR__ . '/externals/');
    }
}

if (!(function_exists('require_vendor')))
{
    function require_vendor(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
    }
}

if (!(function_exists('dd')))
{
    function dd(mixed $data): void
    {
        echo "<pre>";
        var_dump($data);
        die;
    }
}

if (!(function_exists('service')))
{
    function service(string $service): mixed
    {
        return app()->getContainer()->get($service);
    }
}
