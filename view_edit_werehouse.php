<?php

require_once 'koneksi_database.php';
require_once 'werehouse.php';

//konkesi database 
$database = new Database();
$db = $database->mendapatkan_koneksi();

// membuat objek werehouse
$werehouse = new Werehouse($db);

// mednapatkan id werehouse dari url
$werehouse->id = isset($_GET['id']) ? $_GET['id'] : die("error: ID tidak ditemukan.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $werehouse->name = $_POST['name'];
    $werehouse->location = $_POST['lokasi'];
    $werehouse->capacity = $_POST['kapasitas'];
    $werehouse->status = $_POST['status'];
    $werehouse->opening_hour = $_POST['open'];
    $werehouse->closing_hour = $_POST['close'];

    if ($werehouse->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "$err";
        echo "gagal update pelanggan";
    }
} else {
    //mendapatkan data werehouse berdasarkan id
    $stmt = $werehouse->show($werehouse->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    //ini nama filed di table
    $werehouse->name = $data['name'];
    $werehouse->location = $data['location'];
    $werehouse->capacity = $data['capacity'];
    $werehouse->status = $data['status'];
    $werehouse->opening_hour = $data['opening_hour'];
    $werehouse->closing_hour = $data['closing_hour'];
}

ob_start();
?>

<h1 class="text-center">edit data pelanggan</h1>

<form action="view_edit_werehouse.php?id=<?php echo $werehouse->id; ?>" method="post">
    <div class="card container mx-auto">
        <div class="mb-2">
            <label for="name">Nama Gudang
            </label>
            <input type="text" name="name" id="name" value="<?php echo $werehouse->name ?>"><br>
        </div>

        <div class="mb-2">
            <label for="lokasi">lokasi Gudang
            </label>
            <input type="text" name="lokasi" id="lokasi" value="<?php echo $werehouse->location ?>"><br>
        </div>

        <div class="mb-2">
            <label for="kapasitas">kapasitas Gudang
            </label>
            <input type="text" name="kapasitas" id="kapasitas" value="<?php echo $werehouse->capacity ?>"><br>
        </div>

        <div class="mb-2">
            <label for="status">status Gudang
            </label>
            <select name="status" id="">
                <option value="">---==----</option>
                <option value="aktif" <?php echo ($werehouse->status == "aktif") ? 'selected' : ''; ?>>aktif</option>
                <option value="tidak_aktif" <?php echo ($werehouse->status == "tidak_aktif") ? 'selected' : ''; ?>>tidak aktif</option>
            </select>
        </div>

        <div class="mb-2">
            <label for="open">jam buka Gudang
            </label>
            <input type="time" name="open" id="open" value="<?php echo $werehouse->opening_hour ?>"><br>
        </div>

        <div class="mb-2">
            <label for="close">jam tutup Gudang
            </label>
            <input type="time" name="close" id="close" value="<?php echo $werehouse->closing_hour ?>"><br>
        </div>
        <input type="submit" value="update data werehouse" class="btn btn-sm btn-primary w-100 my-3">

    </div>
</form>

<?php
$content = ob_get_clean();

include "template.php";

?>