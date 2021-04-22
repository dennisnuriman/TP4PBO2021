<?php 
class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM mahasiswa";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function add($nama, $nim, $tanggalLahir, $jenisKelamin, $email, $telephone, $personalSite, $status){
		$query = "INSERT INTO mahasiswa".
            "(nama, nim, tanggalLahir, jenisKelamin, email, telephone, personalSite, status) VALUES".
            "('$nama', '$nim', '$tanggalLahir', '$jenisKelamin', '$email', '$telephone', '$personalSite', '$status')";

		return $this->execute($query);
	}

	function delete($id){
		$query = "DELETE FROM mahasiswa WHERE id = '$id'";

		return $this->execute($query);
	}

	function setStatus($id){

		$query = "UPDATE mahasiswa SET status='Sudah' WHERE id='$id'";

		return $this->execute($query);
	}
	
}
