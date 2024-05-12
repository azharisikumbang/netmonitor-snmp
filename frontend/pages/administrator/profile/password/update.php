<?php


if (!session()->auth())
    response()->redirectTo(site_url(session()->user()->getRole()->redirectPage()));

if (!request()->isPostRequest())
    response()->notFound();

use App\Services\UpdatePasswordService;

$reqPassword = request()->get('password');
$reqPasswordConfirmation = request()->get('password-confirmation');

if (is_null($reqPassword) || is_null($reqPasswordConfirmation))
    response()->redirectTo(
        site_url('administrator/profile/password/edit'),
        [
            'errors' => [['message' => 'Kata sandi konfirmasi yang anda masukkan masih kosong, mohon coba kembali.']],
            'old' => []
        ]
    );

if (strlen($reqPassword) < 8 || strlen($reqPasswordConfirmation) < 8)
    response()->redirectTo(
        site_url('administrator/profile/password/edit'),
        [
            'errors' => [['message' => 'Panjang kata sandi harus 8 karakter atau lebih, mohon coba kembali.']],
            'old' => []
        ]
    );


/** @var UpdatePasswordService $service */
/** @var false|\App\Entities\User $user */
$service = service(UpdatePasswordService::class);
$updated = $service->updateUserPassword($reqPassword, $reqPasswordConfirmation);

if (false === $updated) // has error
    response()->redirectTo(
        site_url('administrator/profile/password/edit'),
        [
            'errors' => [['message' => 'Kata sandi konfirmasi yang anda masukkan tidak sama, mohon coba kembali.']],
            'old' => []
        ]
    );

// success
session()->logout();
response()->redirectTo(site_url('auth/login'), ['success' => "Kata sandi telah dirubah, silahkan login kembali."]);