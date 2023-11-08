<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("koneksi.php");
if (!isset($_SESSION['username'])) {
    header("Location: LoginUser.php");
    exit;
}
// Lanjutkan kode halaman ini jika sudah login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Navbar Example</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
</head>
<body>
    
<!-- form dokter -->
<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <?php
    $nama = '';
    $alamat = '';
    $no_hp = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, "SELECT * FROM dokter 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $no_hp = $row['no_hp'];
        }
    ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php
    }
    ?>

    <div class="form-group mx-sm-3 mb-2">
            <label for="inputNama" class="form-label fw-bold">
                Nama
            </label>
            <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="<?php echo $nama; ?>">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputAlamat" class="form-label fw-bold">
                Alamat
            </label>
            <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat; ?>">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputNoHP" class="form-label fw-bold">
                Nomor HP
            </label>
            <input type="text" class="form-control" name="no_hp" id="inputNoHP" placeholder="Nomor HP" value="<?php echo $no_hp; ?>">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>

    </form>



<!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No HP</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
        $result = mysqli_query(
            $mysqli,"SELECT * FROM dokter"
            );
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?= $data['nama'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" 
                    href="dokter.php?id=<?php echo $data['id'] ?>">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" 
                    href="dokter.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- aksi-->

<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
                                nama = '" . $_POST['nama'] . "',
                                alamat = '" . $_POST['alamat'] . "',
                                no_hp = '" . $_POST['no_hp'] . "'
                                WHERE
                                id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO dokter(nama,alamat,no_hp) 
                                VALUES ( 
                                    '" . $_POST['nama'] . "',
                                    '" . $_POST['alamat'] . "',
                                    '" . $_POST['no_hp'] . "'
                                    )");
    }

    echo "<script> 
        document.location='dokter.php';
    </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
    }
    echo "<script> 
        document.location='dokter.php';
    </script>";
}
?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRfJ9f5jz3I4/3r5F5I5j5qofnVf5U1kAl7vC4ks7x" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-nDLU77O4f9vG4JqF01f8Uxl5KveGqZyl5Ci8FQITu97uQOGcnJw92ag0C6w5W/pj" crossorigin="anonymous"></script>
</body>
</html>