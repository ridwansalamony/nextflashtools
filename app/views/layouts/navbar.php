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
                        <a href="<?= BASEURL; ?>logout" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white text-base">Sign out</a>
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
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar1" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'Tutupan Ulang' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Tutupan Ulang <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar1" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>closing/daily" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == 'Tutupan Ulang' ? 'bg-primary text-white' : '' ?>">Tutupan Harian Ulang</a>
                            </li>
                            <li>
                                <a href="<?= BASEURL; ?>closing/monthly" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Tutupan Bulanan Ulang</a>
                            </li>
                            <!-- <li>
                                <a href="<?= BASEURL; ?>closing/backup" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Backup Bulanan</a>
                            </li> -->
                            <li>
                                <a href="<?= BASEURL; ?>closing/initial" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Initial C</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar2" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'Check Data' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Cek Data<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar2" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <!-- <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Mstran</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Mtran</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Prodmast</a>
                            </li> -->
                            <li>
                                <a href="<?= BASEURL ?>check/stmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == 'Check Data' ? 'bg-primary text-white' : '' ?>">Stmast</a>
                            </li>
                            <!-- <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Supmast</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Passtoko</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Data Corrupt</a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <!-- <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar3" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == '1' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Manual Query<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar3" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Semua Toko</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Beberapa Toko</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <!-- <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar4" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == '1' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">PB<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar4" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Devisiasi</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Ulang PB</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Ulang Cek Barang</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Error HR PBSL</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <!-- <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar5" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == '1' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">New Jutsu<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar5" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">EDC Setting</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Timeout EDC</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Station Apka</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Hapus Stockol_id</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Hapus Berita Acara</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Tambah NIK Toko</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Idelivery Pesanan</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Ubah PKM</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Open BKL</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Hitung Ulang Stock</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Finger</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Setting 24 Jam</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Ubah SB</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">File SB</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <!-- <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar6" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == '1' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Simulasi<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar6" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Setting Simulasi</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">Cek Simulasi</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar7" class="flex items-center justify-between w-full py-2 pl-3 pr-4 <?= $data['title'] == 'Transfer Data' ? 'bg-primary text-white xl:text-primary xl:bg-transparent' : '' ?> hover:text-white rounded hover:bg-primary xl:hover:bg-transparent xl:hover:text-primary xl:p-0 xl:w-auto">Transfer Data<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar7" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>prodmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == 'Transfer Data' ? 'bg-primary text-white' : '' ?> <?= $data['title'] == '1' ? 'bg-primary text-white' : '' ?>">DT,DT_/TMT and TRPR</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>