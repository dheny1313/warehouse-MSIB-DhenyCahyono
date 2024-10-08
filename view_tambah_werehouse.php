<?php
require_once 'koneksi_database.php';
require_once 'werehouse.php';

//membuat koneksi
$database = new Database();
$db = $database->mendapatkan_koneksi();

//membuat objek pelanggan 
$werehouse = new Werehouse($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $werehouse->name = $_POST['name'];
    $werehouse->location = $_POST['lokasi'];
    $werehouse->capacity = $_POST['kapasitas'];
    $werehouse->status = $_POST['status'];
    $werehouse->opening_hour = $_POST['open'];
    $werehouse->closing_hour = $_POST['close'];

    if ($werehouse->create()) {
        header("location: index.php");
        exit;
    } else {
        echo "gagal menambah data werehouse";
    }
}

ob_start();
?>

<h1>tambah data Werehouse</h1>
<form action="view_tambah_werehouse.php" method="post">
    <div class="mb-2">
        <label for="name">Nama Gudang
        </label>
        <input type="text" name="name" id="name"><br>
    </div>

    <div class="mb-2">
        <label for="lokasi">lokasi Gudang
        </label>
        <input type="text" name="lokasi" id="lokasi"><br>
    </div>

    <div class="mb-2">
        <label for="kapasitas">kapasitas Gudang
        </label>
        <input type="text" name="kapasitas" id="kapasitas"><br>
    </div>

    <div class="mb-2">
        <label for="status">status Gudang
        </label>
        <select name="status" id="">
            <option value="">---==----</option>
            <option value="aktif">aktif</option>
            <option value="tidak_aktif">tidak aktif</option>
        </select>
    </div>

    <div class="mb-2">
        <label for="open">jam buka Gudang
        </label>
        <input type="time" name="open" id="open"><br>
    </div>

    <div class="mb-2">
        <label for="close">jam tutup Gudang
        </label>
        <input type="time" name="close" id="close"><br>
    </div>
    <input type="submit" value="tambah pelanggan " class=" btn btn-primary btn-sm">
    <button class="btn btn-sm btn-warning"><a href="index.php" target="_blank" rel="noopener noreferrer">kembali</a></button>
</form>

<?php

// ngambil template 
$content = ob_get_clean();

include 'template.php';

?>