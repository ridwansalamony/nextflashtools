<nav class="bg-white border-gray-200 fixed z-50 w-full">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="<?= BASEURL; ?>" class="flex items-center">
            <img src="<?= BASEURL; ?>public/src/img/flash.png" class="h-8 mr-3" alt="Flas Tools Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap hover:text-primary">FLASH TOOLS</span>
        </a>
        <div class="flex items-center xl:order-2">
            <button type="button" class="flex mr-3 text-sm rounded-full xl:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=<?= $data['user'] ?>" alt="User Avatar">
            </button>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-base text-gray-900"><?= $data['user']; ?></span>
                    <span class="block text-base  text-gray-500 truncate"><?= $data['user']; ?>@gmail.com</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="<?= BASEURL; ?>logout" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white text-base">Logout</a>
                    </li>
                </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-500 rounded-lg xl:hidden hover:bg-primary hover:text-white text-base focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full xl:flex xl:w-auto xl:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 gap-2 xl:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 xl:flex-row xl:space-x-4 xl:mt-0 xl:border-0 xl:bg-white">
                <li>
                    <a href="<?= BASEURL; ?>" class="block py-2 pl-3 pr-4 <?= $data['title'] == 'Beranda' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0" aria-current="page">Beranda</a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>store" class="block py-2 pl-3 pr-4 <?= $data['title'] == 'Daftar Toko' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0">Daftar Toko</a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar1" class="flex items-center justify-between w-full py-2 pl-3 pr-4 relative <?= $data['title'] == 'Tutupan Ulang' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Tutupan
                        <img src="<?= BASEURL; ?>public/src/img/new-label.png" alt="Label New" width="40" class="absolute -top-3 -left-5">
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar1" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700 flex flex-col gap-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>closing/shift" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Tutupan Shift' ? 'bg-primary text-white' : '' ?>">
                                    Tutupan Shift
                                    <span class="ml-2 bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">NEW!</span>
                                </a>
                            <li>
                                <a href="<?= BASEURL; ?>closing/daily" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Tutupan Harian' ? 'bg-primary text-white' : '' ?>">Tutupan Harian</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>closing/monthly" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Tutupan Bulanan' ? 'bg-primary text-white' : '' ?>">Tutupan Bulanan</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>closing/initial" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Initial C' ? 'bg-primary text-white' : '' ?>">Initial C</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>closing/errorpbsl" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Error PBSL' ? 'bg-primary text-white' : '' ?>">Error Harian PBSL</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar2" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'Check Data' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Cek Data<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar2" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700 flex flex-col gap-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL ?>check/mstran" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Mstran' ? 'bg-primary text-white' : '' ?>">Mstran</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL ?>check/mtran" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Mtran' ? 'bg-primary text-white' : '' ?>">Mtran</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL ?>check/prodmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Prodmast' ? 'bg-primary text-white' : '' ?>">Prodmast</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL ?>check/stmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Stmast' ? 'bg-primary text-white' : '' ?>">Stmast</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL ?>check/supmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Supmast' ? 'bg-primary text-white' : '' ?>">Supmast</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL ?>check/passtoko" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Passtoko' ? 'bg-primary text-white' : '' ?>">Passtoko</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar3" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'Manual Query' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Manual Query<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar3" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700 flex flex-col gap-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>manual/all" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'All Toko' ? 'bg-primary text-white' : '' ?>">Semua Toko</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>manual/part" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Part Toko' ? 'bg-primary text-white' : '' ?>">Beberapa Toko</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar4" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'PB' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">PB<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar4" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700 flex flex-col gap-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>pb/reopenpb" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Reopen PB' ? 'bg-primary text-white' : '' ?>">Buka Ulang PB/Listing</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>pb/reopenpbx" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Reopen Cek' ? 'bg-primary text-white' : '' ?>">Buka Ulang Cek Barang</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar5" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'Flash' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Flash<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar5" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700 flex flex-col gap-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>flash/settingedc" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Setting EDC' ? 'bg-primary text-white' : '' ?>">EDC Setting</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/timeoutedc" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Timeout EDC' ? 'bg-primary text-white' : '' ?>">Timeout EDC</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/stationapka" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Station APKA' ? 'bg-primary text-white' : '' ?>">Setting Station APKA</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/beritaacara" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Berita Acara' ? 'bg-primary text-white' : '' ?>">Hapus Berita Acara</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/addnik" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Tambah NIK' ? 'bg-primary text-white' : '' ?>">Tambah NIK Toko</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/openbkl" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Open BKL' ? 'bg-primary text-white' : '' ?>">Open BKL</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/recalculate" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Hitung Ulang Stock' ? 'bg-primary text-white' : '' ?>">Hitung Ulang Stock</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/setting24" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Setting 24' ? 'bg-primary text-white' : '' ?>">Setting 24 Jam</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>flash/custdisplay" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Customer Display' ? 'bg-primary text-white' : '' ?>">Customer Display</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar7" class="flex items-center justify-between w-full py-2 pl-3 pr-4 relative <?= $data['title'] == 'Load Data' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">
                        <img src="<?= BASEURL; ?>public/src/img/new-label.png" alt="Label New" width="40" class="absolute -top-3 -left-5">
                        Load Data
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar7" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700 flex flex-col gap-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>load/prodmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Update Prodmast' ? 'bg-primary text-white' : '' ?>">Prodmast</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>load/table" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['nav'] == 'Table' ? 'bg-primary text-white' : '' ?>">
                                    Data Table
                                    <span class="ml-2 bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">NEW!</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>