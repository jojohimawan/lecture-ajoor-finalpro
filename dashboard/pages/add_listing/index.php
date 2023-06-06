<?php 
    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: ./../../../auth");
    }

    require_once __DIR__ . "./../../../php/conn/index.php";
    require_once __DIR__ . "./../../../php/func/index.php";
    
    // get needed data
    $categories = queryReadKategori();

    // handle create produk
    if( isset($_POST["submit"]) ) {
        if(queryCreateProduk($_POST) > 0) {
            echo 
                '<script> 
                alert("Sukses menambah produk")
                </script>
            ';
        } else {
            echo 
                '<script> 
                alert("Gagal menambah produk")
                </script>
            ';
        }
    }

    $listingRowcount = getRowCount("SELECT * FROM produk WHERE user_id = '{$_SESSION["user_id"]}'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="icon"  href="./../../../assets/favicon.jpg" />
    <title>Dashboard - Buat Listing</title>
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
                <a href="./../../../" class="flex items-center justify-around p-5 text-slate-700 text-2xl font-semibold rounded-lg bg-white mb-10">
                <img src="./../../../assets/Logo.jpg" class="w-6" alt="Logo">
                <span class="">Ajoor</span>
                </a>
            </li>
            <li>
                <a href="./../../" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <span class="ml-3">Listing Produk</span>
                </a>
            </li>
            <li>
                <a href="./../transaksi" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
                </svg>
                <span class="ml-3">Transaksi</span>
                </a>
            </li>
            <li>
                <a href="./../manajemen_transaksi" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 01-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004zM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 01-.921.42z" />
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v.816a3.836 3.836 0 00-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 01-.921-.421l-.879-.66a.75.75 0 00-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 001.5 0v-.81a4.124 4.124 0 001.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 00-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 00.933-1.175l-.415-.33a3.836 3.836 0 00-1.719-.755V6z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Manajemen Transaksi</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-5 text-white rounded-lg hover:bg-green-700 bg-green-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6 text-gray-500">
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
                eLearning sisi pengguna dosen memiliki akses untuk membuat kelas dan input serta edit nilai mahasiswa.
            </p>
            <a class="text-sm text-green-700 underline font-medium hover:text-green-800  " href="#">Turn new navigation off</a>
        </div>
    </div>
    </aside>

    <div class="py-12 px-24 sm:ml-64">
        <div class="w-full flex flex-row items-center justify-between p-4 pb-12 mb-12 border-b">
                <div class="flex flex-col gap-y-2">
                    <div class="text-3xl text-slate-900 font-semibold">
                        Tambahkan Listing Produk
                    </div>
                </div>
                <div class="flex flex-col gap-y-2">
                    <div class="text-lg text-slate-400 font-medium">
                        Jumlah Listing
                    </div>
                    <div class="text-3xl text-slate-900 font-semibold">
                        <?= $listingRowcount ?>
                    </div>
                </div>
                <div class="flex flex-col gap-y-2">
                    <div class="text-lg text-slate-400 font-medium">
                            Transaksi Tertunda
                        </div>
                        <div class="text-3xl text-slate-900 font-semibold">
                            0
                        </div>
                </div>
                <div class="flex flex-col gap-y-2">
                    <div class="text-lg text-slate-400 font-medium">
                        Total Pembelian
                    </div>
                    <div class="text-3xl text-slate-900 font-semibold">
                        0
                    </div>
                </div>
                    
            </div>

        <form action="" method="post" class="p-4" enctype="multipart/form-data">
            <div class="mb-6">
                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label> <!-- kategori -->
                <select type="text" id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <?php foreach ($categories as $cat) : ?>
                    <option class="text-base" value=<?= $cat['kategori_id'] ?> ><?= $cat['nama']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6"> 
                <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe</p> <!-- tipe -->
                <div class="flex flex-column w-full gap-x-3">
                    <div class="flex items-center px-4 border border-gray-200 rounded">
                        <input checked id="premium" type="radio" value="f" name="gratis" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="premium" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Premium</label>
                    </div>
                    <div class="flex items-center px-4 border border-gray-200 rounded">
                        <input id="freebie" type="radio" value="t" name="gratis" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="freebie" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Freebie</label>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <label for="produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label> <!-- nama -->
                <input type="text" id="produk" name="produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6">
                <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thumbnail</label> <!-- foto -->
                <input type="file" id="foto" name="foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6">
                <label for="fileproduk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Produk</label> <!-- file -->
                <input type="file" id="fileproduk" name="fileproduk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6">
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label> <!-- deskripsi -->
                <textarea id="deskripsi" name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-[10em] p-2.5" required></textarea>
            </div>
            <div class="mb-6">
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label> <!-- harga -->
                <input type="number" id="harga" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6">
                <label for="userid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label> <!-- user id -->
                <input type="hidden" id="userid" name="userid" value="<?= intval($_SESSION["user_id"]); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  required>
            </div>
            
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center gap-x-3" name="submit">Buat Listing</button>
        </form>
    </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>