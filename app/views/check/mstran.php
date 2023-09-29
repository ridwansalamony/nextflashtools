<section class="wrapper pt-24 pb-[100px]">
    <main class="content bg-white max-w-screen-xl mx-auto rounded-md py-6 px-4 xl:px-20">

        <?php Flasher::flash(); ?>

        <div class="flex justify-between border-b-2 mb-6 pb-2">
            <h1 class="text-2xl font-semibold uppercase">Cek Data Stmast</h1>
        </div>
        <form action="<?= BASEURL; ?>check/mstranup" method="POST">
            <div class="form grid grid-cols-1 gap-4">
                <div class="md:w-1/6 mx-auto">
                    <img src="<?= BASEURL; ?>public/src/img/indomaret.png" alt="Indomaret Logo" width="200">
                </div>
                <div class="w-full md:w-1/2 mx-auto flex gap-2">
                    <div class="w-full">
                        <select name="pass" class="bg-gray-50 border text-lg border-gray-300 rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                            <option value="old">Pass SQL 2023</option>
                            <option value="new">Pass SQL 2023-New</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <input type="text" name="kode_toko" class="bg-gray-50 border border-gray-300 text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Kode Toko : TXXX" maxlength="4" required>
                    </div>
                </div>

                <div class="w-full md:w-1/2 mx-auto">
                    <input type="text" name="plu" class="bg-gray-50 border border-gray-300 text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Cek berdasarkan PLU : 20xxxx,20xxxx">
                </div>
                <div class="w-full md:w-1/2 mx-auto">
                    <input type="text" name="npb" class="bg-gray-50 border border-gray-300 text-lg rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Cek berdasarkan nomor NPB">
                </div>
                <div class="w-full md:w-1/2 mx-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker type="date" name="tanggal_proses" class="bg-gray-50 border border-gray-300 text-lg rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-2.5 ">
                    </div>
                </div>

                <div class="w-full md:w-1/2 mx-auto">
                    <button type="submit" name="submit" id="submit" class="w-full bg-primary text-white  hover:bg-secondary focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                        Proses
                    </button>

                    <button id="loading" class="w-full bg-gray-300 text-primary font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 hidden" disabled>

                        <div role="status" class="flex justify-center">
                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-secondary" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                            </svg>
                            <span>Loading...</span>
                        </div>

                    </button>
                </div>
            </div>
        </form>
        <div class="my-20">
            <table id="tablex" class="w-full table-auto overflow-hidden">
                <thead class="uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No NPB
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Prdcd
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rtype
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keter
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bukti Proses
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Proses
                        </th>
                    </tr>
                </thead>
                <tbody class="text-base text-gray-600">
                    <?php if (isset($data['result'])) : ?>
                        <?php foreach ($data['result'] as $item) : ?>
                            <tr class="border-b hover:bg-gray-50 text-lg bg-green-200">
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <?= $item['npb']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <?= $item['prdcd']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <?= $item['rtype']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <?= $item['keter']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <?= $item['bukti']; ?>
                                </td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <?= $item['tanggal']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>