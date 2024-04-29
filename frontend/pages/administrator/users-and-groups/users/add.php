<?php

use App\Enum\Role;

$roles = Role::cases();

?>
<div class="w-full px-4 p-2 bg-gray-100">
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="<?= site_url('administrator/dashboard') ?>">Administrator</a></li>
            <li><a href="<?= site_url('administrator/users-and-groups/index') ?>">Grup dan Pengguna</a></li>
            <li><a href="<?= site_url('administrator/users-and-groups/users') ?>">Kelola Pengguna</a></li>
            <li>Tambah Data</li>
        </ul>
    </div>
</div>

<?php if (isset(session('temp')['errors']))
{
    html_form_errors(session('temp')['errors']);
} ?>


<div class="mt-4">
    <form action="<?= site_url('administrator/users-and-groups/users/store') ?>" method="post" class="w-1/2">
        <div>
            <h2 class="font-bold text-lg">
                Informasi Pengguna
            </h2>
            <div class="mb-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Nama Lengkap Pengguna</span>
                    </div>
                    <input name="name" type="text" class="input input-bordered w-full"
                        value="<?= session('temp')['old']['name'] ?? '' ?>" required />
                </label>
            </div>
            <div class="mb-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Kontak (No. Handphone)</span>
                    </div>
                    <input name="contact" type="text" class="input input-bordered w-full"
                        value="<?= session('temp')['old']['contact'] ?? '' ?>" required />
                </label>
            </div>
            <div class="mb-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Alamat Lengkap</span>
                    </div>
                    <textarea name="address" class="textarea textarea-bordered w-full"
                        required><?= session('temp')['old']['address'] ?? '' ?></textarea>
                </label>
            </div>
        </div>
        <div>
            <h2 class="font-bold text-lg">
                Informasi Akun
            </h2>
            <div class="mb-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Username akun</span>
                    </div>
                    <input name="username" type="text" class="input input-bordered w-full"
                        value="<?= session('temp')['old']['username'] ?? '' ?>" required />
                </label>
            </div>
            <div class="mb-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Password Akun</span>
                    </div>
                    <input name="password" type="password" class="input input-bordered w-full" required />
                </label>
            </div>
            <div class="mb-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Grup pengguna</span>
                    </div>

                    <select name="role" class="select select-bordered w-full" required>
                        <?php $oldRole = session('temp')['old']['role'] ?? ""; ?>
                        <?php foreach ($roles as $role)
                        { ?>
                            <option <?php echo ($oldRole == $role->name) ? "selected" : "" ?> value="<?= $role->name ?>">
                                <?= $role->displayAs() ?>
                            </option>
                        <?php } ?>
                    </select>
                </label>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success text-white w-1/3">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    stroke="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M18.1716 1C18.702 1 19.2107 1.21071 19.5858 1.58579L22.4142 4.41421C22.7893 4.78929 23 5.29799 23 5.82843V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H18.1716ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21L5 21L5 15C5 13.3431 6.34315 12 8 12L16 12C17.6569 12 19 13.3431 19 15V21H20C20.5523 21 21 20.5523 21 20V6.82843C21 6.29799 20.7893 5.78929 20.4142 5.41421L18.5858 3.58579C18.2107 3.21071 17.702 3 17.1716 3H17V5C17 6.65685 15.6569 8 14 8H10C8.34315 8 7 6.65685 7 5V3H4ZM17 21V15C17 14.4477 16.5523 14 16 14L8 14C7.44772 14 7 14.4477 7 15L7 21L17 21ZM9 3H15V5C15 5.55228 14.5523 6 14 6H10C9.44772 6 9 5.55228 9 5V3Z"
                        fill="#FFF" />
                </svg>
                Simpan Data
            </button>
        </div>
    </form>
</div>