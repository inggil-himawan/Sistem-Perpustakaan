<?php
$page_title = "Tambah Anggota Baru";
require_once 'database.php';
require_once 'header.php';
 
// Inisialisasi variabel
$errors = [];
$kode_anggota = '';
$nama = '';
$email = '';
$telepon = '';
$alamat = '';
$tanggal_lahir = '';
$jenis_kelamin = '';
$pekerjaan = '';
$tanggal_daftar = '';
$foto = '';
$status = 'Aktif';

$obj_tanggal_lahir = new DateTime($tanggal_lahir);
$sekarang = new DateTime();
$selisih = $sekarang->diff($obj_tanggal_lahir);
$tahun = $selisih->y;
$bulan = $selisih->m;
$hari = $selisih->d;
 
// Proses form jika di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi data
    $kode_anggota = sanitize($_POST['kode_anggota']);
    $nama = sanitize($_POST['nama']);
    $email = sanitize($_POST['email']);
    $telepon = sanitize($_POST['telepon']);
    $alamat = sanitize($_POST['alamat']);
    $tanggal_lahir = sanitize($_POST['tanggal_lahir']);
    $jenis_kelamin = sanitize($_POST['jenis_kelamin']);
    $pekerjaan = sanitize($_POST['pekerjaan']);
    $tanggal_daftar = sanitize($_POST['tanggal_daftar']);
    // $foto = sanitize($_POST['foto']);
    $status = 'Aktif';
    
    // Validasi
    if (empty($kode_anggota)) {
        $errors[] = "Kode anggota wajib diisi";
    }
    
    if (empty($nama)) {
        $errors[] = "Nama wajib diisi";
    } elseif (strlen($nama) < 3) {
        $errors[] = "Nama minimal 3 karakter";
    }
    
    if (empty($email)) {
        $errors[] = "Email wajid diisi";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($telepon)) {
        $errors[] = "Nomor telepon wajid diisi";
    } else if (!preg_match('/^08\d{8,13}$/',$telepon)) {
        $errors[] = "Format telepon tidak valid"; 
    }
    
    if (empty($alamat)) {
        $errors[] = "Alamat wajib diisi";
    }
    
    if (empty($tanggal_lahir)) {
        $errors[] = "Tanggal lahir Wajib diisi";
    }
    if ($tahun > 10) {
        $errors[] = "Umur minimal 10 tahun";
    }
    
    if (empty($jenis_kelamin)) {
        $errors[] = "Jenis kelamin wajib dipilih";
    }
    
    if (empty($pekerjaan)) {
        $errors[] = "Pekerjaan wajib diisi";
    }

    if (empty($tanggal_daftar)) {
        $errors[] = "Tanggal daftar wajib diisi";
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nama_file = uniqid('foto_') . '.' . $ext;
        $upload_dir = '../../uploads/anggota/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $nama_file);
        $foto = $nama_file;
    }
    
    // Cek kode buku duplikat
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_anggota FROM anggota WHERE kode_anggota = ?");
        $stmt->bind_param("s", $kode_anggota);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "Kode Anggota sudah digunakan";
        }
        $stmt->close();
    }

    // Cek email duplikat
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_anggota FROM anggota WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Email sudah digunakan";
        }
        $stmt->close();
    }
    
    // Jika tidak ada error, insert ke database
    if (count($errors) == 0) {
        $stmt = $conn->prepare("INSERT INTO anggota (kode_anggota, nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, pekerjaan, tanggal_daftar, foto,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssssssss", 
            $kode_anggota,
            $nama,
            $email,
            $telepon,
            $alamat,
            $tanggal_lahir,
            $jenis_kelamin,
            $pekerjaan,
            $tanggal_daftar,
            $foto,
            $status
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            closeConnection();
            header("Location: index.php?success=" . urlencode("Anggota '$nama' berhasil ditambahkan"));
            exit();
        } else {
            $errors[] = "Error database: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>
 
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-plus-circle"></i> Tambah Anggota Baru
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Tampilkan Error -->
                    <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <h6><i class="bi bi-exclamation-triangle"></i> Terdapat kesalahan:</h6>
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Kode Anggota & Nama -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="kode_buku" class="form-label">
                                    Kode Anggota <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="kode_anggota" 
                                       name="kode_anggota" 
                                       value="<?php echo htmlspecialchars($kode_anggota); ?>"
                                       placeholder="AGT-001" 
                                       required>
                            </div>
                            
                            <div class="col-md-8 mb-3">
                                <label for="judul" class="form-label">
                                    Nama <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nama" 
                                       name="nama" 
                                       value="<?php echo htmlspecialchars($nama); ?>"
                                       placeholder="Masukkan nama anggota" 
                                       required>
                            </div>
                        </div>

                        <!-- Email & Telepon -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="judul" class="form-label">
                                    Telepon <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="telepon" 
                                       name="telepon" 
                                       value="<?php echo htmlspecialchars($telepon); ?>"
                                       placeholder="08XXXXXXXXX" 
                                       required>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="kode_buku" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="<?php echo htmlspecialchars($email); ?>"
                                       placeholder="inggil12@gmail.com" 
                                       required>
                            </div>
                        </div>
                        
                        <!-- Jenis Kelamin & Tanggal Lahir -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label d-block">
                                    Jenis Kelamin <span class="text-danger">*</span>
                                </label>  
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Laki-laki" id="laki" <?php echo ($jenis_kelamin == 'Laki-laki') ? 'checked' : ''; ?> style="transform: scale(1.5); margin-right: 5px;" required>
                                    <label class="form-check-label ms-1" for="laki" style="font-size: 0.9rem;">Laki-laki</label>
                                </div>
                                
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Perempuan" id="perempuan" <?php echo ($jenis_kelamin == 'Perempuan') ? 'checked' : ''; ?> style="transform: scale(1.5); margin-right: 5px;" required>
                                    <label class="form-check-label ms-1" for="perempuan" style="font-size: 0.9rem;">Perempuan</label>
                                </div>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="tanggal_lahir" class="form-label">
                                    Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                    class="form-control form-control-md" 
                                    name="tanggal_lahir" value="<?php echo htmlspecialchars($tanggal_lahir); ?>" 
                                    required>
                            </div>
                        </div>
                        
                        <!-- Tanggal Daftar dan Pekerjaan -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tanggal_daftar" class="form-label">
                                    Tanggal Daftar <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                        class="form-control" 
                                        id="tanggal_daftar"
                                        name="tanggal_daftar" 
                                        value="<?php echo htmlspecialchars($tanggal_daftar); ?>" 
                                        required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="pekerjaan" class="form-label">
                                    Pekerjaan <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                        class="form-control" 
                                        id="pekerjaan" 
                                        name="pekerjaan" 
                                        value="<?php echo htmlspecialchars($pekerjaan); ?>"
                                        placeholder="Masukkan Pekerjaan" 
                                        required>
                            </div>
                        </div>

                        <!-- Foto dan Alamat -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="judul" class="form-label">
                                    Foto <span class="text-danger">*</span>
                                </label>
                                <input type="file" 
                                        class="form-control" 
                                        id="foto" 
                                        name="foto" 
                                        value="<?php echo htmlspecialchars($foto); ?>">
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="deskripsi" class="form-label">
                                    Alamat</label> <span class="text-danger">*</span>
                                <textarea class="form-control" 
                                        id="alamat" 
                                        name="alamat" 
                                        rows="3" 
                                        placeholder="Masukkan alamat dengan lengkap"><?php echo htmlspecialchars($alamat); ?></textarea>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Data Buku
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
<?php
closeConnection();
require_once 'footer.php';
?>