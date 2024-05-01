<?php

$page = $_GET['page'] ?? 1;
$total = $_GET['total'] ?? 10;
$search = $_GET['search'] ?? '';
$group = $_GET['group'] ?? '';

// buld query for paginations
unset($_GET[\App\Core\Router::PATH_QUERY_NAME]);
unset($_GET['page']);
$queryString = http_build_query($_GET);

// retrieve data
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
        <?= html_load_component('form-search-table-panel', ['title' => 'Cari nama pengguna', 'value' => $search]) ?>
        <form action="" method="get">
            <div class="flex justify-end gap-2 items-end">
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Saring berdasarkan grup pengguna</span>
                        </div>
                        <select class="select select-bordered" name="group">
                            <option value="">-- Tampilkan Semua --</option>
                            <?php foreach ($roles as $role)
                            { ?>
                                <option value="<?= $role->value ?>" <?= $group == $role->name ? 'selected' : '' ?>>
                                    <?= $role->displayAs() ?>
                                </option>
                            <?php } ?>
                        </select>
                    </label>
                </div>
                <div>
                    <button class="btn">Terapkan Penyaringan</button>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-4">
        <div class="overflow-x-auto">
            <table class="table">
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
                        { ?>
                            <tr class="hover">
                                <th><?= $no++ ?></th>
                                <td><?= $user->getName() ?></td>
                                <td><?= $user->getRole()->displayAs() ?></td>
                                <td><?= $user->getUsername() ?></td>
                                <td><?= $user->getCreatedAt()->format("d/m/Y H:i:s") ?> WIB</td>
                                <td class="w-48">
                                    <div class="flex justify-end gap-4">
                                        <a class="link link-accent font-normal"
                                            href="<?= site_url('administrator/users-and-groups/users/edit?id=' . $user->getId()) ?>">
                                            Edit</a>
                                        <a class="link link-accent font-normal"
                                            href="<?= site_url('administrator/users-and-groups/users/detail?id=' . $user->getId()) ?>">Lihat
                                            Data</a>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php html_load_component('table-pagination', ['page' => $page, 'query' => $queryString]) ?>
    </div>
</div>