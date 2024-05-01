<?php

if (is_null(session()->auth()))
    response()->redirect(site_url("auth/login"));

if (session()->auth()['users']->getRole() !== \App\Enum\Role::ADMINISTRATOR)
    response()->unauthorized();

$targetActivedUser = request()->get('activatedID');

$succed = service(\App\Services\UserService::class)->activateUserAccount($targetActivedUser);

if (false === $succed)
    response()->redirectTo(site_url('administrator/users-and-groups/users/'), ['errors' => ['message' => 'Gagal mengaktifkan pengguna, mohon coba kembali beberapa saat.']]);

// success
response()->redirectTo(site_url('administrator/users-and-groups/users/detail?id=' . $targetActivedUser), ['success' => "Pengguna telah diaktifkan kembali."]);