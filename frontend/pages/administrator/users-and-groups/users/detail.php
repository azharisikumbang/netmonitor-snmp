<?php
use App\Enum\EntityRowStatus;

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

<?php
$tempSession = session('temp');

if (isset($tempSession['success']))
    html_form_success(session('temp')['success']);

if (isset($tempSession['errors']))
    html_form_errors(session('temp')['errors']);

?>

<div class="mt-8">
    <div class="flex justify-between items-center mb-2">
        <h2 class="font-bold text-lg">
            Detail Pengguna (username = <?= $user->getUsername() ?>)
        </h2>
        <div class="flex gap-2">
            <a class="btn btn-neutral text-white"
                href="<?= site_url('administrator/users-and-groups/users/edit?id=' . $user->getId()) ?>">
                Edit Detail Pengguna</a>
            <div>
                <?php
                if ($user->getEntityRowStatus() === EntityRowStatus::ACTIVE)
                { ?>
                    <div>
                        <button class="btn btn-error text-white" onclick="modal_confirm_delete.showModal()">Non-aktifkan
                            Pengguna</button>
                        <dialog id="modal_confirm_delete" class="modal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">Peringatan!</h3>
                                <p class="py-4">Menonaktifkan pengguna akan menyebabkan pengguna tidak lagi dapat mengakses
                                    akun. Apakah anda yakin?</p>
                                <div class="modal-action flex justify-end">
                                    <form action="<?= site_url('administrator/users-and-groups/users/deactivate') ?>"
                                        method="post">
                                        <input type="hidden" name="deactivatedID" value="<?= $user->getId() ?>" readonly>
                                        <button class="btn btn-success text-white">Lanjutkan</button>
                                    </form>
                                    <form method="dialog">
                                        <button class="btn">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                <?php } else
                { ?>
                    <div>
                        <button class="btn btn-success text-white" onclick="modal_confirm_delete.showModal()">Aktifkan
                            Akun Pengguna</button>
                        <dialog id="modal_confirm_delete" class="modal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">Peringatan!</h3>
                                <p class="py-4">Anda yakin ingin mengaktifkan akun pengguna ini lagi?</p>
                                <div class="modal-action flex justify-end">
                                    <form action="<?= site_url('administrator/users-and-groups/users/activate') ?>"
                                        method="post">
                                        <input type="hidden" name="activatedID" value="<?= $user->getId() ?>" readonly>
                                        <button class="btn btn-success text-white">Lanjutkan</button>
                                    </form>
                                    <form method="dialog">
                                        <button class="btn">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                <?php } ?>
            </div>
        </div>
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
            <td class="w-48">Status Akun</td>
            <td>: <?= $user->getEntityRowStatus()->displayAs() ?></td>
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
            <td>: <?= $user->getCreatedAtAsString() ?></td>
        </tr>
        <tr class="hover">
            <td class="w-48">Terakhir Diperbaharui</td>
            <td>: <?= $user->getUpdatedAtAsString() ?></td>
        </tr>
    </table>
</div>