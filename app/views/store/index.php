<section class="wrapper pt-24 pb-[100px]">
    <main class="content bg-white max-w-screen-xl mx-auto rounded-md py-6 px-4 xl:px-20">
        <div class="flex justify-between border-b-2 mb-4">
            <h1 class="text-2xl font-semibold uppercase">Daftar Toko</h1>
            <button type="button" class="bg-primary text-white  hover:bg-secondary focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Tambah Toko</button>
        </div>

        <table id="tablex" class="w-full table-auto overflow-x-auto">
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
                            <a href="#" class="bg-blue-100 hover:bg-blue-200 text-info font-semibold mr-2 px-2.5 py-0.5 rounded hover:text-info border border-blue-400 inline-flex items-center justify-center">Edit</a>
                            <a href="#" class="bg-red-100 hover:bg-red-200 text-secondary font-semibold mr-2 px-2.5 py-0.5 rounded hover:text-primary border border-red-400 inline-flex items-center justify-center">Hapus</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>