<?php

if (is_null(session()->auth()))
    response()->redirect(site_url("auth/login"));

if (session()->auth()['users']->getRole() !== \App\Enum\Role::ADMINISTRATOR)
    response()->unauthorized();

$targetDeactivedUser = request()->get('deactivatedID');

$deactivated = service(\App\Services\UserService::class)->deactivateUserAccount($targetDeactivedUser);

if (false === $deactivated)
    response()->redirectTo(site_url('administrator/users-and-groups/users/'), ['errors' => ['message' => 'Gagal menonaktifkan pengguna, mohon coba kembali beberapa saat.']]);

// success
response()->redirectTo(site_url('administrator/users-and-groups/users/detail?id=' . $targetDeactivedUser), ['success' => "Pengguna telah dinonaktifkan."]);