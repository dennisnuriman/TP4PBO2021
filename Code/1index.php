<?php

/******************************************
PRAKTIKUM RPL
 ******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();
if (isset($_POST['add'])) {
    $nama = $_POST['tnama'];
    $nim = $_POST['tnim'];
    $tanggalLahir = $_POST['ttanggalLahir'];
    $jenisKelamin = $_POST['tjenisKelamin'];
    $email = $_POST['temail'];
    $telephone = $_POST['ttelephone'];
    $personalSite = $_POST['tpersonalSite'];
    $status = "Belum";

    $otask->add($nama, $nim, $tanggalLahir, $jenisKelamin, $email, $telephone, $personalSite, $status);

    header("location:1index.php");
}

if (isset($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];

    $otask->delete($id);
    header("location:1index.php");
}

if (isset($_GET['id_status'])) {
    $id = $_GET['id_status'];

    $otask->setStatus($id);
    header("location:1index.php");
}



// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tnama, $tnim, $ttanggalLahir, $tjenisKelamin, $temail, $ttelephone, $tpersonalSite, $tstatus) = $otask->getResult()) {
    // Tampilan jika status task nya sudah dikerjakan
    if ($tstatus == "Sudah") {
        $data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
        <td>" . $tnim . "</td>
		<td>" . $ttanggalLahir . "</td>
		<td>" . $tjenisKelamin . "</td>
		<td>" . $temail . "</td>
		<td>" . $ttelephone . "</td>
        <td>" . $tpersonalSite . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='1index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
        $no++;
    }

    // Tampilan jika status task nya belum dikerjakan
    else {
        $data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
        <td>" . $tnim . "</td>
		<td>" . $ttanggalLahir . "</td>
		<td>" . $tjenisKelamin . "</td>
		<td>" . $temail . "</td>
		<td>" . $ttelephone . "</td>
        <td>" . $tpersonalSite . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='1index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='1index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
        $no++;
    }
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/tampil.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();
