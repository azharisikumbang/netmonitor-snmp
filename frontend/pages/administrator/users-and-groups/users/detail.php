<?php

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
            <td>: <?= "0812-3456-7890"; // TODO: Nomor handphone belum diimplementasikan  ?></td>
        </tr>
        <tr class="hover">
            <td class="w-48">Alamat Lengkap</td>
            <td>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde quisquam hic labore
                alias praesentium
                dicta quaerat libero, atque sint, blanditiis incidunt accusantium ipsam nemo! Saepe placeat deserunt
                beatae ratione reiciendis.</td>
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
            <td>: <?= $user->getCreatedAt()->format("d/m/y H:i:s") ?> WIB</td>
        </tr>
        <tr class="hover">
            <td class="w-48">Terakhir Diperbaharui</td>
            <td>: -</td>
        </tr>
    </table>
</div>