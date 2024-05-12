<div class="w-full px-4 p-2 bg-gray-100">
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="<?= site_url('administrator/dashboard') ?>">Administrator</a></li>
            <li>Grup dan Pengguna</li>
        </ul>
    </div>
</div>

<div class="mt-4">
    <div class="w-1/2">
        <table class="table">
            <thead>
                <tr class="uppercase font-bold">
                    <th>Grup dan Pengguna</th>
                    <th class="w-96"></th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                <tr>
                    <td class="font-bold">Pengguna</td>
                    <td>
                        <div class="flex justify-end gap-4">
                            <a class="link link-hover font-normal"
                                href="<?= site_url('administrator/users-and-groups/users/add') ?>">
                                Tambah Data</a>
                            <a class="link link-hover font-normal"
                                href="<?= site_url('administrator/users-and-groups/users') ?>">Lihat
                                Data</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Grup</td>
                    <td>
                        <div class="flex justify-end gap-4">
                            <a class="link link-hover font-normal" href="<?= site_url('administrator/dashboard') ?>">
                                Tambah Data</a>
                            <a class="link link-hover font-normal"
                                href="<?= site_url('administrator/dashboard') ?>">Lihat
                                Data</a>
                        </div>
                    </td>
                </tr>
        </table>
    </div>
</div>