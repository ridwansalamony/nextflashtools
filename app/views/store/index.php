<section class="wrapper pt-24 pb-[100px]">
    <main class="content bg-white max-w-screen-xl mx-auto rounded-md py-6 px-4 xl:px-20">
        <div class="flex justify-between border-b-2 mb-4">
            <h1 class="text-2xl font-semibold uppercase">Daftar Toko</h1>
            <button type="button" class="text-white bg-primary hover:bg-secondary focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Tambah Toko</button>
        </div>

        <div class="overflow-x-auto sm:rounded-md">
            <table id="tablex" class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                <tbody>
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
                                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </main>