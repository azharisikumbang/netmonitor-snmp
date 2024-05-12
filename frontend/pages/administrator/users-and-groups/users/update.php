<?php

if (!session()->auth())
    response()->redirectTo(site_url(session()->auth()['users']->getRole()->redirectPage()));

if (!request()->isPostRequest())
    response()->notFound();

use App\Services\UpdateUserInformationService;

/** @var UpdateUserInformationService $userCreatorService */
/** @var false|\App\Entities\User $user */
$userCreatorService = service(UpdateUserInformationService::class);
$updated = $userCreatorService->update(request());

if ($updated['has_error'] || false === $updated) // has error
    response()->redirectTo(
        site_url('administrator/users-and-groups/users/edit'),
        [
            'errors' => $updated['errors'],
            'old' => $updated['validated']
        ]
    );

// success
response()->redirectTo(site_url('administrator/users-and-groups/users/detail?id=' . request()->get('id')), ['success' => "Data pengguna berhasil diperbaharui."]);