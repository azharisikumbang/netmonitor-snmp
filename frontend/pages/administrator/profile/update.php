<?php


if (!session()->auth())
    response()->redirectTo(site_url(session()->user()->getRole()->redirectPage()));

if (!request()->isPostRequest())
    response()->notFound();

use App\Services\UpdateMyProfileService;

/** @var UpdateMyProfileService $service */
/** @var false|\App\Entities\User $user */
$service = service(UpdateMyProfileService::class);
$updated = $service->updateUserInformation(request());

if ($updated['has_error'] || false === $updated) // has error
    response()->redirectTo(
        site_url('administrator/profile/edit'),
        [
            'errors' => $updated['errors'],
            'old' => $updated['validated']
        ]
    );

// success
response()->redirectTo(site_url('administrator/profile/edit'), ['success' => "Profile berhasil diperbaharui."]);