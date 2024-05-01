<?php

if (is_null(session()->auth()))
    response()->redirect(site_url("auth/login"));

$idUser = $_GET['id'] ?? null;
if (empty($idUser) || is_null($idUser))
    response()->notFound();

/** @var \App\Entities\User $user */
$user = service(\App\Services\UserService::class)->getUserDetail($idUser);

?>
<div class="w-full px-4 p-2 bg-gray-100">
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="<?= site_url('administrator/dashboard') ?>">Administrator</a></li>
            <li><a href="<?= site_url('administrator/users-and-groups/index') ?>">Grup dan Pengguna</a></li>
            <li><a href="<?= site_url('administrator/users-and-groups/users') ?>">Kelola Pengguna</a></li>
            <li>Detail Pengguna</li>
        </ul>
    </div>
</div>

<?php if (session('temp') != null)
{
    html_form_success(session('temp'));
} ?>

<div class="mt-8">
    <div class="flex justify-between items-center mb-2">
        <h2 class="font-bold text-lg">
            Detail Pengguna (username = <?= $user->getUsername() ?>)
        </h2>
        <a class="btn btn-neutral text-white"
            href="<?= site_url('administrator/users-and-groups/users/edit?id=' . $user->getId()) ?>">
            Edit Detail Pengguna</a>
    </div>

    <table class="table table-lg">
        <tr class="bg-gray-200">
            <th colspan="2" class="font-medium">Informasi Pribadi</td>
        </tr>
        <tr class="hover">
            <td class="w-48">Nama Lengkap</td>
            <td>: <?= $user->getName() ?></td>
        </tr>
        <tr class="hover">
            <td class="w-48">Kontak / No. Handphone</td>
            <td>: <?= $user->getContact(); ?></td>
        </tr>
        <tr class="hover">
            <td class="w-48">Alamat Lengkap</td>
            <td>: <?= $user->getAddress() ?></td>
        </tr>
    </table>

    <table class="table table-lg">
        <tr class="bg-gray-200">
            <th colspan="2" class="font-medium">Informasi Akun</td>
        </tr>
        <tr class="hover">
            <td class="w-48">Username</td>
            <td>: <?= $user->getUsername() ?></td>
        </tr>
        <tr class="hover">
            <td class="w-48">Grup Pengguna (Hak Akses)</td>
            <td>: <?= $user->getRole()->displayAs() ?></td>
        </tr>
        <tr class="hover">
            <td class="w-48">Bergabung Pada</td>
            <td>: <?= $user->getCreatedAt()->format("d-m-Y H:i:s") ?> WIB</td>
        </tr>
        <tr class="hover">
            <td class="w-48">Terakhir Diperbaharui</td>
            <td>: <?= $user->getUpdatedAt()->format("d-m-Y H:i:s") ?> WIB</td>
        </tr>
    </table>
</div>