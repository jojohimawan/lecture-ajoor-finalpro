<?php 
    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: ./../../../auth");
    }

    require_once __DIR__ . "./../../../php/conn/index.php";
    require_once __DIR__ . "./../../../php/func/index.php";
    
    // get needed data
    $id = $_GET["produk_id"];
    $row = queryRead("SELECT produk.*, kategori.nama AS kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.kategori_id WHERE produk_id = $id");
    $row["gratis"] = $row['gratis'] === 't' ? 'freebie' : 'premium';
    $categories = queryReadKategori();

    // handle create produk
    if( isset($_POST["submit"]) ) {
        if(queryUpdateListingProduk($_POST) > 0) {
            echo 
                '<script> 
                alert("Sukses update produk")
                document.location.href = "./../../../dashboard"
                </script>
            ';
        } else {
            echo 
                '<script> 
                alert("Gagal update produk")
                </script>
            ';
        }
    }
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
    <title>Update Produk</title>
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
                <a href="#" class="flex items-center p-5 text-white rounded-lg hover:bg-green-700 bg-green-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6 text-gray-500">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Update Listing</span>
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
        <div class="w-full flex flex-row items-center gap-x-24 p-4 pb-12 mb-12 border-b">
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Update listing produk:
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $row["nama"] ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Kategori produk:
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $row["kategori"] ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Tipe produk:
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $row["gratis"] ?>
                </div>
            </div>
        </div>

        <form action="" method="post" class="p-4" enctype="multipart/form-data">
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
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label> <!-- deskripsi -->
                <textarea id="deskripsi" name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-[10em] p-2.5"><?= $row['deskripsi'] ?></textarea>
            </div>
            <div class="mb-6">
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label> <!-- harga -->
                <input type="number" id="harga" name="harga" value="<?= $row['harga'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-6">
                <label for="produkid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label> <!-- produk id -->
                <input type="hidden" id="produkid" name="produkid" value="<?= $id ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  required>
            </div>
            
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center gap-x-3" name="submit">Edit Listing</button>
        </form>
    </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>