<nav class="bg-white border-gray-200 fixed z-50 w-full">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="<?= BASEURL; ?>" class="flex items-center">
            <img src="<?= BASEURL; ?>public/src/img/flash.png" class="h-8 mr-3" alt="Flas Tools Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">FLASH TOOLS</span>
        </a>
        <div class="flex items-center xl:order-2">
            <button type="button" class="flex mr-3 text-sm rounded-full xl:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=<?= $data['user'] ?>" alt="User Avatar">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-base text-gray-900"><?= $data['user']; ?></span>
                    <span class="block text-base  text-gray-500 truncate">awhost@gmail.com</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white text-base">Sign out</a>
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
            <ul class="flex flex-col font-medium p-4 xl:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 xl:flex-row xl:space-x-4 xl:mt-0 xl:border-0 xl:bg-white">
                <li>
                    <a href="<?= BASEURL; ?>" class="block py-2 pl-3 pr-4  <?= $data['title'] == 'Beranda' ? 'xl:text-primary text-white bg-primary rounded' : '' ?> xl:p-0 xl:hover:text-primary xl:bg-transparent" aria-current="page">Beranda</a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>store" class="block py-2 pl-3 pr-4  <?= $data['title'] == 'Daftar Toko' ? 'xl:text-primary text-white bg-primary rounded' : '' ?> xl:p-0 xl:hover:text-primary xl:bg-transparent">Daftar Toko</a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar1" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto">Tutupan Ulang <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar1" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Tutupan Harian Ulang</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Tutupan Bulanan Ulang</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Backup Bulanan</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Initial C</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar2" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto">Cek Data<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar2" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Mstran</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Mtran</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Prodmast</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Stmast</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Supmast</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Passtoko</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Data Corrupt</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar3" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto">Manual Query<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar3" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Semua Toko</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Beberapa Toko</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar4" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto">PB<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar4" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Devisiasi</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Ulang PB</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Ulang Cek Barang</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Error HR PBSL</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar5" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto">New Jutsu<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar5" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">EDC Setting</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Timeout EDC</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Station Apka</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Hapus Stockol_id</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Hapus Berita Acara</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Tambah NIK Toko</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Idelivery Pesanan</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Ubah PKM</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Open BKL</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Hitung Ulang Stock</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Finger</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Setting 24 Jam</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Ubah SB</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">File SB</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar6" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto">Simulasi<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar6" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Setting Simulasi</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">Cek Simulasi</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar7" class="flex items-center justify-between w-full py-2 pl-3 pr-4 border-b border-gray-100 hover:bg-gray-50 xl:bg-transparent xl:hover:bg-transparent xl:border-0 xl:hover:text-primary xl:p-0 xl:w-auto <?= $data['title'] == 'Update Prodmast' ? 'xl:text-primary text-white bg-primary rounded' : '' ?>">Transfer Data<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar7" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm mt-2 text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="<?= BASEURL; ?>prodmast" class="block px-4 py-2 hover:bg-primary hover:text-white text-base <?= $data['title'] == 'Update Prodmast' ? 'bg-primary text-white' : '' ?>">DT,DT_/TMT Bulan 1-9</a>
                            </li>
                            <!-- <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">DT,DT_/TMT Bulan 10</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">DT,DT_/TMT Bulan 11</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">DT,DT_/TMT Bulan 12</a> -->
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-primary hover:text-white text-base">TRPR New</a>
                </li>
            </ul>
        </div>
        </li>
        </ul>
    </div>
    </div>
</nav>