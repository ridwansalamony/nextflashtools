<section class="wrapper pt-24 pb-[100px]">
    <main class="content bg-white max-w-screen-xl mx-auto rounded-md py-6 px-4 xl:px-20">
        <div class="flex justify-between border-b-2 mb-6 pb-2">
            <h1 class="text-2xl font-semibold uppercase">Update Prodmast Joss</h1>
        </div>
        <form action="<?= BASEURL; ?>prodmast/update" method="POST">
            <div class="form grid grid-cols-1 gap-4">
                <div class="w-1/2 mx-auto flex gap-2">
                    <div class="w-full">
                        <!-- <label for="pass" class="block text-lg font-medium text-center">Pilih Password</label> -->
                        <select id="pass" name="pass" class="bg-gray-50 border text-lg border-gray-300 rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                            <option value="<?= DB_PASS_TOKO_OLD; ?>">Pass SQL 2023</option>
                            <option value="<?= DB_PASS_TOKO_NEW; ?>">Pass SQL 2023-New</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <!-- <label for="bulan" class="block text-lg font-medium text-center">Pilih Bulan Prodmast</label> -->
                        <select id="bulan" name="bulan" class="bg-gray-50 border text-lg border-gray-300 rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                            <option value="<?= substr(date('m'), 1); ?>">Bulan 1-9</option>
                            <option value="A">Bulan 10</option>
                            <option value="B">Bulan 11</option>
                            <option value="C">Bulan 12</option>
                        </select>
                    </div>
                </div>
                <div class="w-1/2 mx-auto">
                    <!-- <label for="kode_toko" class="block text-lg font-medium text-center">Masukkan Kode Toko </label> -->
                    <input type="text" name="kode_toko" id="kode_toko" class="bg-gray-50 border border-gray-300 text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Pisah dengan kutip : 'kode','kode' dst ..." required>
                </div>
                <div class="w-1/2 mx-auto">
                    <button type="submit" name="submit" class="w-full bg-primary text-white  hover:bg-secondary focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 focus:outline-none">Update Prodmast</button>
                </div>
            </div>
        </form>

        <div class="my-20">
            <table id="tablex" class="w-full table-auto overflow-hidden">
                <thead class="uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Kode Toko
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Toko
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="text-base text-gray-600">
                    <?php if (isset($data['store'])) : ?>
                        <?php foreach ($data['store'] as $item) : ?>
                            <tr class="bg-white border-b hover:bg-gray-50 <?= $data['status'] ? 'bg-green-200' : 'bg-red-200' ?>">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                    <?= $item['toko']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                    <?= $item['nama']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                    <?= $data['status'] ? 'Berhasil' : 'Gagal'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td>

                            </td>

                            <td>
                                <p class="text-center p-4 text-lg">Tidak ada data</p>
                            </td>

                            <td>

                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>