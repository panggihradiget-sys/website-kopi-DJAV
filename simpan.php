<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak diizinkan");
}

$koneksi = mysqli_connect("localhost", "root", "", "db_kopi");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nama  = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$no_hp = $_POST['no_hp'] ?? '';

if ($nama == '' || $email == '' || $no_hp == '') {
    die("Data tidak lengkap");
}

// simpan ke customer
$sql_customer = "INSERT INTO customer (nama, email) VALUES ('$nama', '$email')";
if (!mysqli_query($koneksi, $sql_customer)) {
    die("Gagal simpan customer: " . mysqli_error($koneksi));
}

$customer_id = mysqli_insert_id($koneksi);

// simpan ke kontak
$sql_kontak = "INSERT INTO kontak (customer_id, no_hp)
               VALUES ('$customer_id', '$no_hp')";
if (!mysqli_query($koneksi, $sql_kontak)) {
    die("Gagal simpan kontak: " . mysqli_error($koneksi));
}

echo "✅ Data berhasil disimpan";
?>
