<?php

$page = $_GET['page'] ?? 0;
$total = $_GET['total'] ?? 10;
$search = $_GET['search'] ?? '';
$group = $_GET['group'] ?? '';

$users = service(\App\Services\UserService::class)->retriveUserList($total, $page, $search, $group);
$roles = \App\Enum\Role::cases();

?>
<div class="w-full px-4 p-2 bg-gray-100">
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="<?= site_url('administrator/dashboard') ?>">Administrator</a></li>
            <li><a href="<?= site_url('administrator/users-and-groups/index') ?>">Grup dan Pengguna</a></li>
            <li>Kelola Pengguna</li>
        </ul>
    </div>
</div>

<?php if (session('temp') != null)
{
    html_form_success(session('temp'));
} ?>

<div class="mt-4">
    <div class="flex justify-between items-end">
        <form action="" method="get">
            <div class="label">
                <span class="label-text">Cari nama pengguna</span>
            </div>
            <label class="input input-bordered flex items-center gap-2">
                <input type="text" name="search" class="grow w-96" placeholder="Tekan enter untuk mencari.."
                    value="<?= $search ?>" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        <form action="" method="get">
            <div class="flex justify-end gap-2 items-end">
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Saring berdasarkan grup pengguna</span>
                        </div>
                        <select class="select select-bordered" name="group">
                            <option disabled selected>Pilih satu</option>
                            <?php foreach ($roles as $role)
                            { ?>
                                <option value="<?= $role->value ?>" <?= $group == $role->name ? 'selected' : '' ?>>
                                    <?= $role->displayAs() ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </div>
                <!-- <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Saring berdasarkan status</span>
                        </div>
                        <select class="select select-bordered">
                            <option disabled selected>Pilih Satu</option>
                            <option>Karyawan Aktif</option>
                            <option>Karyawan Non-Aktif</option>
                        </select>
                    </label>
                </div> -->
                <div>
                    <button class="btn">Terapkan Penyaringan</button>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-4">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr class="uppercase font-bold">
                        <th class="w-8"></th>
                        <th>Nama</th>
                        <th>Grup Pengguna / Jabatan</th>
                        <th>Username</th>
                        <th>Bergabung pada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($users))
                    { ?>
                        <tr class="hover">
                            <td class="text-center italic" colspan="5">Tidak ada data.</td>
                        </tr>
                    <?php } else
                    {
                        $no = 1;
                        foreach ($users as $user)
                        /** @var \App\Entities\User $user */
                        { ?>
                            <tr class="hover">
                                <th><?= $no++ ?></th>
                                <td><?= $user->getName() ?></td>
                                <td><?= $user->getRole()->displayAs() ?></td>
                                <td><?= $user->getUsername() ?></td>
                                <td><?= $user->getCreatedAt()->format("d/m/Y H:i:s") ?> WIB</td>
                            </tr>
                        <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="join mt-8 flex justify-end">
            <a class="join-item btn" href="?page=<?= $page - 1 ?>">« Sebelumnya</a>
            <a class="join-item btn" href="?page=<?= $page + 1 ?>">Selanjutnya »</a>
        </div>
    </div>
</div>