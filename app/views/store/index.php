<section class="wrapper pt-24 pb-[100px]">
    <main class="content bg-white max-w-screen-xl mx-auto rounded-md py-6 px-4 xl:px-20">

        <?php Flasher::flash(); ?>

        <div class="flex justify-between border-b-2 mb-4">
            <h1 class="text-2xl font-semibold uppercase">Daftar Toko</h1>
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="bg-primary text-white  hover:bg-secondary focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none tambah-toko">Tambah Toko</button>
        </div>

        <table id="tablex" class="display nowrap" style="width: 100%;">
            <thead class="uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kode Toko
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Toko
                    </th>
                    <th scope="col" class="px-6 py-3">
                        IP Induk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="text-base text-gray-600">
                <?php $no = 1; ?>
                <?php foreach ($data['store'] as $item) : ?>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?= $no; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?= $item['toko']; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?= $item['nama']; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?= $item['induk']; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" data-code="<?= $item['toko'] ?>" class="bg-blue-100 hover:bg-blue-200 text-info font-semibold mr-2 px-2.5 py-0.5 rounded hover:text-info border border-blue-400 inline-flex items-center justify-center edit-toko">Edit</a>
                            <a href="<?= BASEURL ?>store/delete/<?= $item['toko'] ?>" class="bg-red-100 hover:bg-red-200 text-secondary font-semibold mr-2 px-2.5 py-0.5 rounded hover:text-primary border border-red-400 inline-flex items-center justify-center sweetalert-confirm">Hapus</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="modal-label mb-4 text-xl font-medium"></h3>
                    <form class="form-modal space-y-6" action="<?= BASEURL; ?>store/add" method="POST">
                        <div>
                            <label for="kode_toko" class="block mb-2 text-sm font-medium ">Kode Toko</label>
                            <input id="kode_toko" type="text" name="kode_toko" class="bg-gray-50 border border-gray-300 font-bold text-primary text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="TXXX or FXXX" maxlength="4" required>
                        </div>
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium ">Nama Toko</label>
                            <input id="nama" type="text" name="nama" class="bg-gray-50 border border-gray-300 font-bold text-primary text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="KUBANG JAYA 88" maxlength="50" required>
                        </div>
                        <div>
                            <label for="induk" class="block mb-2 text-sm font-medium ">IP Induk</label>
                            <input id="induk" type="text" name="induk" class="bg-gray-50 border border-gray-300 font-bold text-primary text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="10.56.xx.xx" maxlength="20" required>
                        </div>
                        <button type="submit" name="submit" class="w-full text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-lg px-5 py-2.5 text-center">Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div>