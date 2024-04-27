<?php
use App\Helpers\SessionManager;

if (session()->auth())
    response()->redirect(site_url(session()->auth()->getRole()->redirectPage()));

if (!request()->isPostRequest())
    response()->notFound();


use App\Services\AuthenticatorService;

$username = $_POST['username'];
$password = $_POST['password'];

/** @var AuthenticatorService $authenticator */
/** @var false|\App\Entities\User $user */
$authenticator = service(AuthenticatorService::class);
$user = $authenticator->check($username, $password);

if (false === $user)
    response()->redirectTo(site_url('auth/login'), ['status' => false, 'message' => 'Username atau password salah, silahkan coba kembali.']);

// authenticated
SessionManager::createAuthenticatedSession($user);

response()->redirectTo(site_url($user->getRole()->redirectPage()));