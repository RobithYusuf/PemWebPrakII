
<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
</head>
<body>

<?php

// --- koneksi ke database
$koneksi = mysqli_connect("localhost","root","","pengiriman") ;
if ($koneksi->connect_error) {
    # code...
    die("Koneksi gagal : " . $koneksi->connect_error);
}else {
    # code...
    echo "(Koneksi Berhasil)";
}
//--- menutup sintaks koneksi

// --- Fngsi tambah data (Create)
function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$id = time();
		$nm_pengiriman = $_POST['nm_pengiriman'];
		$berat = $_POST['berat'];
		$perkiraan = $_POST['perkiraan'];
		$tgl_sampai = $_POST['tgl_sampai'];
		
		if(!empty($nm_pengiriman) && !empty($berat) && !empty($perkiraan) && !empty($tgl_sampai)){
			$sql = "INSERT INTO tabel_panen (id,nama_pengirim, nama_barang, berat_barang, tanggal_kirim) VALUES(".$id.",'".$nm_pengiriman."','".$berat."','".$perkiraan."','".$tgl_sampai."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}

	?> 
		<form action="" method="POST">
			<fieldset>
				<legend><h2>Tambah data</h2></legend>
				<label>Nama Pengirim <input type="text" name="nm_pengiriman" /></label> <br>
				<label>Nama Barang <input type="text" name="berat" /> </label><br>
				<label>Berat Barang<input type="number" name="perkiraan" /> kg</label> <br>
				<label>Tanggal Kirim <input type="date" name="tgl_sampai" /></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_simpan" value="Simpan"/>
					<input type="reset" name="reset" value="Besihkan"/>
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</fieldset>
		</form>
	<?php

}
// --- Tutup Fungsi tambah data


// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
	$sql = "SELECT * FROM tabel_panen";
	$query = mysqli_query($koneksi, $sql);
	
	echo "<fieldset>";
	echo "<legend><h2>Data Pengiriman Barang</h2></legend>";
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr>
			<th>ID</th>
			<th>Nama Pengirim</th>
			<th>Nama Barang</th>
			<th>Berat Barang</th>
			<th>Tanggal Kirim</th>
			<th>Tindakan</th>
		  </tr>";
	
	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['nama_pengirim']; ?></td>
				<td><?php echo $data['nama_barang']; ?> </td>
				<td><?php echo $data['berat_barang']; ?> kg</td>
				<td><?php echo $data['tanggal_kirim']; ?></td>
				<td>
					<a href="index.php?aksi=update&id=<?php echo $data['id']; ?>&nama=<?php echo $data['nama_pengirim']; ?>&berat=<?php echo $data['nama_barang']; ?>&perkiraan=<?php echo $data['berat_barang']; ?>&tanggal=<?php echo $data['tanggal_kirim']; ?>">Ubah</a> |
					<a href="index.php?aksi=delete&id=<?php echo $data['id']; ?>">Hapus</a>
				</td>
			</tr>
		<?php
	}
	echo "</table>";
	echo "</fieldset>";
}
// --- Tutup Fungsi Baca Data (Read)


// --- Fungsi Ubah Data (Update)
function ubah($koneksi){

	// ubah data
	if(isset($_POST['btn_ubah'])){
		$id = $_POST['id'];
		$nm_pengiriman = $_POST['nm_pengiriman'];
		$berat = $_POST['berat'];
		$perkiraan = $_POST['perkiraan'];
		$tgl_sampai = $_POST['tgl_sampai'];
		
		if(!empty($nm_pengiriman) && !empty($berat) && !empty($perkiraan) && !empty($tgl_sampai)){
			$perubahan = "nama_pengirim='".$nm_pengiriman."',nama_barang=".$berat.",berat_barang=".$perkiraan.",tanggal_kirim='".$tgl_sampai."'";
			$sql_update = "UPDATE tabel_panen SET ".$perubahan." WHERE id=$id";
			$update = mysqli_query($koneksi, $sql_update);
			if($update && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'update'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Data tidak lengkap!";
		}
	}
	
	// tampilkan form ubah
	if(isset($_GET['id'])){
		?>
			<a href="index.php"> &laquo; Home</a> | 
			<a href="index.php?aksi=create"> (+) Tambah Data</a>
			<hr>
			
			<form action="" method="POST">
			<fieldset>
				<legend><h2>Ubah data</h2></legend>
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
				<label>Nama Pengirim <input type="text" name="nm_pengiriman" value="<?php echo $_GET['nama'] ?>"/></label> <br>
				<label>Nama Barang <input type="text" name="berat" value="<?php echo $_GET['berat'] ?>"/> </label><br>
				<label>Berat Barang<input type="number" name="perkiraan" value="<?php echo $_GET['perkiraan'] ?>"/> kg</label> <br>
				<label>Tanggal Kirim <input type="date" name="tgl_sampai" value="<?php echo $_GET['tanggal'] ?>"/></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>"> (x) Hapus data ini</a>!
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
				
			</fieldset>
			</form>
		<?php
	}
	
}
// --- Tutup Fungsi Update


// --- Fungsi Delete
function hapus($koneksi){

	if(isset($_GET['id']) && isset($_GET['aksi'])){
		$id = $_GET['id'];
		$sql_hapus = "DELETE FROM tabel_panen WHERE id=" . $id;
		$hapus = mysqli_query($koneksi, $sql_hapus);
		
		if($hapus){
			if($_GET['aksi'] == 'delete'){

			}
		}
	}
	
}
// --- Tutup Fungsi Hapus


// ===================================================================

// --- Program Utama
if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="index.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			tambah($koneksi);
			tampil_data($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>
</body>
</html>