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

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.semanticui.min.css">

    <!-- Tailwind CSS -->
    <link href="<?= BASEURL; ?>public/dist/css/output.css" rel="stylesheet">

    <!-- Flowbite -->
    <script src="<?= BASEURL; ?>node_modules/flowbite/dist/flowbite.min.js"></script>
</head>

<body>
    <section class="fullpage bg-background font-manrope min-h-screen text-gray-800 relative w-full text-lg">