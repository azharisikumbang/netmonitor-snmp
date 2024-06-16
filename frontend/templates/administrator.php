<?php /** @var $akun Akun */ $akun = session()->auth()['users']; ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netmonitor - Panel Administrator</title>
    <script src="<?= assets('js/alpine.min.js') ?>" defer></script>
    <link rel="stylesheet" href="<?= assets('css/output.css') ?>">
    <link
        href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAA/4QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERERERERERAAAAAAAAERAQAAAAAAEBEAEAAAAAEAEQABAAAAEAARAAAQAAEAABEAAAEAEAAAEQAAABEAAAARAAAAEQAAABEAAAEAEAAAEQAAEAABAAARAAEAAAAQABEAEAAAAAEAEQEAAAAAABAREAAAAAAAAREREREREREREAAAAAP/wAAF/6AABv9gAAd+4AAHveAAB9vgAAfn4AAH5+AAB9vgAAe94AAHfuAABv9gAAX/oAAD/8AAAAAAAA"
        rel="icon" type="image/x-icon">
</head>

<body class="" x-data="global">
    <nav class="fixed z-30 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <span @click="toggleSidebar"
                        class="hover:bg-gray-200 flex items-center border rounded px-2 cursor-pointer">
                        <svg class="w-5" viewBox="0 0 20 20">
                            <path fill="gray"
                                d="M3.314,4.8h13.372c0.41,0,0.743-0.333,0.743-0.743c0-0.41-0.333-0.743-0.743-0.743H3.314
                                    c-0.41,0-0.743,0.333-0.743,0.743C2.571,4.467,2.904,4.8,3.314,4.8z M16.686,15.2H3.314c-0.41,0-0.743,0.333-0.743,0.743
                                    s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,15.2,16.686,15.2z M16.686,9.257H3.314
                                    c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,9.257,16.686,9.257z">
                            </path>
                        </svg>
                    </span>
                    <a href="<?= site_url() ?>" class="flex text-gray-600 ml-2 md:mr-24">
                        <!-- <img src="https://flowbite-admin-dashboard.vercel.app/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo">-->
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">Panel
                            Administrator</span>
                    </a>
                </div>
                <div class="italic text-sm text-gray-400">
                    <span>Login sebagai <?= $akun->getUsername() ?></span> -
                    <a onclick="window.location.reload()"
                        class="hover:text-red-800 hover:underline text-red-500 cursor-pointer">muat ulang halaman</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex pt-14 overflow-hidden">
        <aside x-show="sites.show_sidebar"
            class="fixed transition-all top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-14 font-normal duration-75 lg:flex transition-width"
            aria-label="Sidebar">
            <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">
                <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                        <ul class="pb-2 space-y-2">
                            <li>
                                <a href="<?= site_url('admin/dashboard') ?>"
                                    class="flex font-semibold items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group">
                                    <svg class="w-6 h-6 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                        <path
                                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                        <path
                                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                    </svg>
                                    <span class="ml-3" sidebar-toggle-item="">Beranda</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="py-2 space-y-2">
                            <li x-data="{ show: false }">
                                <button @click="show = !show" type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group"
                                    aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                        </path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Grup
                                        dan Pengguna</span>
                                    <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul id="dropdown-layouts" style="display: none"
                                    class="py-2 space-y-2 bg-gray-200 rounded px-2" x-show="show">
                                    <li>
                                        <a href="<?= site_url('administrator/users-and-groups/users') ?>"
                                            class="flex items-center py-2 pl-10 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">Kelola
                                            Pengguna</a>
                                    </li>
                                    <li>
                                        <a href="<?= site_url('administrator/users-and-groups/groups') ?>"
                                            class="flex items-center py-2 pl-10 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                                            Kelola Grup
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="py-2 space-y-2">
                            <li x-data="{ show: false }">
                                <button @click="show = !show" type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group"
                                    aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                        </path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Akun
                                        Saya</span>
                                    <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul id="dropdown-layouts" style="display: none"
                                    class="py-2 space-y-2 bg-gray-200 rounded px-2" x-show="show">
                                    <li>
                                        <a href="<?= site_url('administrator/profile/edit') ?>"
                                            class="flex items-center py-2 pl-10 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">Ubah
                                            Profil</a>
                                    </li>
                                    <li>
                                        <a href="<?= site_url('administrator/profile/password/edit') ?>"
                                            class="flex items-center py-2 pl-10 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                                            Ubah Kata Sandi
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= site_url('auth/logout') ?>"
                                    class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path
                                            d="M3.24,7.51c-0.146,0.142-0.146,0.381,0,0.523l5.199,5.193c0.234,0.238,0.633,0.064,0.633-0.262v-2.634c0.105-0.007,0.212-0.011,0.321-0.011c2.373,0,4.302,1.91,4.302,4.258c0,0.957-0.33,1.809-1.008,2.602c-0.259,0.307,0.084,0.762,0.451,0.572c2.336-1.195,3.73-3.408,3.73-5.924c0-3.741-3.103-6.783-6.916-6.783c-0.307,0-0.615,0.028-0.881,0.063V2.575c0-0.327-0.398-0.5-0.633-0.261L3.24,7.51 M4.027,7.771l4.301-4.3v2.073c0,0.232,0.21,0.409,0.441,0.366c0.298-0.056,0.746-0.123,1.184-0.123c3.402,0,6.172,2.709,6.172,6.041c0,1.695-0.718,3.24-1.979,4.352c0.193-0.51,0.293-1.045,0.293-1.602c0-2.76-2.266-5-5.046-5c-0.256,0-0.528,0.018-0.747,0.05C8.465,9.653,8.328,9.81,8.328,9.995v2.074L4.027,7.771z">
                                        </path>
                                    </svg>
                                    <span class="ml-3" sidebar-toggle-item="">Keluar Akun</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 text-center w-full p-4 space-x-4 bg-white" sidebar-bottom-menu="">
                    <p class="text-gray-500">&copy; 2024 Netmonitor</p>
                </div>
            </div>
        </aside>
        <div id="main" class="relative w-full h-full overflow-y-auto lg:ml-64 ml:0 transition-all p-4">
            <?php require_once $content; ?>
        </div>
    </div>
    <script src="<?= assets('js/axios.min.js') ?>"></script>
    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('global', () => ({
                sites: {
                    show_sidebar: true
                },
                toggleSidebar: function () {
                    this.sites.show_sidebar = !this.sites.show_sidebar;
                    const main = document.getElementById('main');

                    if (this.sites.show_sidebar) {
                        main.classList.remove('lg:ml-0');
                        main.classList.add('lg:ml-64');

                        return;
                    }

                    main.classList.remove('lg:ml-64');
                    main.classList.add('lg:ml-0');
                }
            }));
        });
    </script>
</body>

</html>