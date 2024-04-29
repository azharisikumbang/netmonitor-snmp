<?php

if (!session()->auth())
    response()->redirectTo(site_url(session()->auth()['users']->getRole()->redirectPage()));

if (!request()->isPostRequest())
    response()->notFound();

use App\Services\UserCreatorService;

/** @var UserCreatorService $userCreatorService */
/** @var false|\App\Entities\User $user */
$userCreatorService = service(UserCreatorService::class);
$created = $userCreatorService->create(request());

if ($created['has_error']) // has error
    response()->redirectTo(
        site_url('administrator/users-and-groups/users/add'),
        [
            'errors' => $created['errors'],
            'old' => $created['validated']
        ]
    );

// success
response()->redirectTo(site_url('administrator/users-and-groups/users'), "Pengguna berhasil ditambahkan.");