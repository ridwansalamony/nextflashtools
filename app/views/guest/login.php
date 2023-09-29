<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?> | Next Flash Tools</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="<?= BASEURL; ?>public/dist/css/output.css" rel="stylesheet">

    <!-- Flowbite -->
    <script src="<?= BASEURL; ?>node_modules/flowbite/dist/flowbite.min.js"></script>
</head>

<body>
    <section class="fullpage bg-background font-manrope min-h-screen text-gray-800 text-lg">
        <main class="min-h-screen flex px-4">
            <div class="bg-white max-w-md m-auto w-full rounded shadow flex flex-col items-center gap-5 py-4">
                <?php Flasher::flash() ?>
                <img src="<?= BASEURL; ?>public/src/img/flash.png" alt="" width="80">
                <form action="<?= BASEURL; ?>guest/login" method="POST" class="w-full max-w-sm">
                    <div class="min-w-full flex flex-col gap-2 px-6">
                        <input type="number" name="username" id="username" class="rounded focus:outline-none focus:ring-primary focus:border-primary" autofocus placeholder="NIK" required>
                        <input type="password" name="password" id="password" class="rounded focus:outline-none focus:ring-primary focus:border-primary" placeholder="Password" required>
                        <button id="submit" type="submit" name="submit" class="w-full bg-primary text-white  hover:bg-secondary focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </section>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>