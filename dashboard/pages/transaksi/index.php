<?php
    session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: ./../auth");
    }

    require_once __DIR__ . "./../../../php/conn/index.php";
    require_once __DIR__ . "./../../../php/func/index.php";

    // get userid
    $userid = intval($_SESSION["user_id"]);

    // get essential data
    $transactions = queryReadAll("SELECT transaksi.*, produk.nama AS nama, produk.foto AS foto, produk.deskripsi AS deskripsi FROM transaksi JOIN produk ON transaksi.produk_id = produk.produk_id WHERE transaksi.user_id = $userid");

    $pendingRowcount = getRowCount("SELECT transaksi.* FROM transaksi JOIN produk ON transaksi.produk_id = produk.produk_id WHERE transaksi.user_id = $userid AND status ='pending'");

    $okRowcount = getRowCount("SELECT transaksi.* FROM transaksi JOIN produk ON transaksi.produk_id = produk.produk_id WHERE transaksi.user_id = $userid AND status ='ok'");

    $transactionRowcount = getRowCount("SELECT transaksi.* FROM transaksi JOIN produk ON transaksi.produk_id = produk.produk_id WHERE transaksi.user_id = $userid");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <title>Home</title>
</head>
<body class="bg-slate-50">

    <button data-drawer-target="cta-button-sidebar" data-drawer-toggle="cta-button-sidebar" aria-controls="cta-button-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
    </button>

    <aside id="cta-button-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-8 overflow-y-auto bg-white border-r">
        <ul class="font-medium">
            <li>
                <a href="./../../index.php" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <span class="ml-3">Listing Produk</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-5 text-white rounded-lg hover:bg-green-700 bg-green-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6 text-gray-500 transition duration-75">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Transaksi</span>
                </a>
            </li>
            <li>
                <a href="./../manajemen_transaksi" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-500 transition duration-75">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Manajemen Transaksi</span>
                </a>
            </li>
            <li>
                <a href="./../add_listing" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-500">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Buat Listing</span>
                </a>
            </li>
            <li>
                <a href="./../../../auth/logout" class="flex items-center p-5 text-red-500 rounded-lg bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </ul>
        <div id="dropdown-cta" class="p-5 mt-6 mx-3 rounded-lg bg-green-50" role="alert">
            <div class="flex items-center mb-3">
                <span class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded">Beta</span>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-800 rounded-lg focus:ring-2 focus:ring-blue-400 p-1 hover:bg-green-200 inline-flex h-6 w-6" data-dismiss-target="#dropdown-cta" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <p class="mb-3 text-sm text-green-700">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio maxime perferendis dolore expedita!
            </p>
            <a class="text-sm text-green-700 underline font-medium hover:text-green-800  " href="#">Turn new navigation off</a>
        </div>
    </div>
    </aside>

    <div class="py-12 px-24 sm:ml-64">
        <div class="w-full flex flex-row items-center justify-between p-4 pb-12 mb-12 border-b">
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Selamat datang,
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $_SESSION['loggeduser'] ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Transaksi Tertunda
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $pendingRowcount ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                        Transaksi Selesai
                    </div>
                    <div class="text-3xl text-slate-900 font-semibold">
                        <?= $okRowcount ?>
                    </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Total Transaksi
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $transactionRowcount ?>
                </div>
            </div>
                
        </div>

        <div class="text-2xl text-slate-900 font-semibold mb-8">
            Transaksi
        </div>

        <div class="table-read bg-white p-5 rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-s text-slate-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($transactions as $tran) : ?>
                            <tr class="bg-white border-b hover:bg-green-50">
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?= $tran["nama"] ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?= $tran["total_harga"] ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?= $tran["deskripsi"] ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <img src="./../../../public/img/<?= $tran['foto'] ?>" class="w-40" alt="Image">
                            </td>
                            <td class="px-6 py-4 font-medium text-base <?php $warna = $tran['status'] === 'pending' ? 'text-red-500' : 'text-green-500'; echo $warna; ?>">
                                <?= $tran["status"] ?>
                            </td>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?php if($tran["status"] === 'pending') : ?>
                                    -
                                <?php else : ?>
                                    <a href="./download/index.php?produk_id=<?= $tran["produk_id"] ?>&transaksi_id=<?= $tran['transaksi_id'] ?>" type="button" class="flex gap-x-2 items-center justify-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Download <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z" clip-rule="evenodd" />
                                    </svg>
                                    </a>
                                <?php endif; ?>
                                
                            </td>
                            </tr>
                        <?php endforeach; ?>
                        <tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>