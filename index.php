<?php
require_once 'koneksi_database.php';
require_once 'werehouse.php'; //kuympulan fungsi atau method sebagai controller

// koneksi database
$database = new Database();
$db = $database->mendapatkan_koneksi();

//membuat objek werehouse
$werehouse = new Werehouse($db);

$stmt = $werehouse->read();
$num = $stmt->rowCount();

// contoh dynamic data
$title = "daftar Werehouse";

// star
ob_start();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<h1>List Werehouse</h1>
<a href="view_tambah_werehouse.php" class="btn btn-success btn-sm mb-4">tambah werehouse</a>

<div class="">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>location</th>
                <th>capacity</th>
                <th>status</th>
                <th>opening_hour</th>
                <th>closing_hour</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo <<<html
                    <tr>
                    <td>{$id}</td>
                    <td>{$name}</td>
                    <td>{$location}</td>
                    <td>{$capacity}</td>
                    <td>{$status}</td>
                    <td>{$opening_hour}</td>
                    <td>{$closing_hour}</td>
                    <td>
                    <a href="view_edit_werehouse.php?id={$id}" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id={$id}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                    </tr>
                    html;
                };
            } else {
                echo <<<html
                <tr>
                    <td colspan="8" class="alert alert-info">Tidak ada data.</td>
                </tr>
                html;
            };
            ?>
    </table>
</div>


<?php
// Capture the content for the layout
$content = ob_get_clean();

// Include the layout template and pass the content
include 'template.php';
?>