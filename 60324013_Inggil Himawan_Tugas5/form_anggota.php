<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Registrasi Anggota</h4>
                    </div>
                
                    <div class="card-body">
                        <?php
                            $errors = [];
                            $success = '';

                            $nama_lengkap = '';
                            $email = '';
                            $telepon = '';
                            $alamat = '';
                            $jenis_kelamin = '';
                            $tanggal_lahir = '';
                            $pekerjaan = '';
                            

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $nama_lengkap = trim(htmlspecialchars($_POST['nama_lengkap']));
                                $email = trim(htmlspecialchars($_POST['email']));
                                $telepon = trim($_POST['telepon']);
                                $alamat = trim(htmlspecialchars($_POST['alamat']));
                                $jenis_kelamin = trim(htmlspecialchars($_POST['jenkel']));
                                $tanggal_lahir =  trim($_POST['tanggal_lahir']);
                                $pekerjaan = trim($_POST['pekerjaan']);
                                filter_var($tanggal_lahir, FILTER_SANITIZE_NUMBER_INT);
                                $obj_tanggal_lahir = new DateTime($tanggal_lahir);
                                $sekarang = new DateTime();
                                $selisih = $sekarang->diff($obj_tanggal_lahir);
                                $tahun = $selisih->y;
                                $bulan = $selisih->m;
                                $hari = $selisih->d;

                                // Val
                                if (empty($nama_lengkap)) {
                                    $errors[] = "Nama wajib diisi";
                                } else if (strlen($nama_lengkap) < 3) {
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
                                    $errors[] = "Email wajid diisi";
                                } else if (strlen($alamat) <= 10) {
                                    $errors[] = "Alamat minimal 10 karakter";
                                }

                                if (empty($jenis_kelamin)) {
                                    $errors[] = "Jenis kelamin wajib diisi";
                                }

                                if (empty($tanggal_lahir)) {
                                    $errors[] = "Tanggal lahir wajid diisi";
                                }
                                if ($tahun < 10) {
                                    $errors[] = "Umur minimal 10 tahun";
                                }

                                if (empty($pekerjaan)) {
                                    $errors[] = "Pekerjaan wajib diisi";
                                }

                                if (count($errors) == 0) {
                                    $success = "Data berhasil disimpan";

                                    $nama_lengkap = '';
                                    $email = '';
                                    $telepon = '';
                                    $alamat = '';
                                    $jenis_kelamin = '';
                                    $tanggal_lahir = '';
                                    $pekerjaan = '';
                                }
                            }

                            
                        ?>

                        <!-- Tampilkan pesan sukses -->
                        <?php if($success):?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle"></i> <?php echo $success; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif;?>

                        <!-- Tampilkan error -->
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <h6><i class="bi bi-exclamation-triangle"></i> Terdapat kesalahan:</h6>
                                <ul class="mb-0">
                                    <?php foreach($errors as $error): ?>
                                        <li><?php echo $error ?></li>
                                    <?php endforeach?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </ul>
                            </div>
                        <?php endif ?>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" placeholder="Minimal 3 karakter" value="<?php echo htmlspecialchars($nama_lengkap); ?>" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label d-block">Jenis Kelamin</label>  
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="jenkel" value="Laki-laki" id="laki" <?php echo ($jenis_kelamin == 'Laki-laki') ? 'checked' : ''; ?> style="transform: scale(1.5); margin-right: 5px;" required>
                                        <label class="form-check-label ms-1" for="laki" style="font-size: 0.9rem;">Laki-laki</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="jenkel" value="Perempuan" id="perempuan" <?php echo ($jenis_kelamin == 'Perempuan') ? 'checked' : ''; ?> style="transform: scale(1.5); margin-right: 5px;" required>
                                        <label class="form-check-label ms-1" for="perempuan" style="font-size: 0.9rem;">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-md" name="tanggal_lahir" value="<?php echo htmlspecialchars($tanggal_lahir); ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label><br>
                                <input type="email" class="form-control" name="email" placeholder="contoh: inggil013@gmail.com" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon">Telepon</label><br>
                                <input type="telpon" class="form-control" name="telepon" placeholder="08xxxxxxxxxx (10-13 digit)" value="<?php echo htmlspecialchars($telepon); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label><br>
                                <textarea name="alamat" id="alamat" class="form-control" rows="4" cols="50" placeholder="Minimal 10 karakter" required><?php echo htmlspecialchars($alamat); ?></textarea>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="jenkel">Jenis Kelamin</label><br>
                                <input type="radio" name="jenkel" value="Laki-laki" <?php echo ($jenis_kelamin == 'Laki-laki') ? 'checked' : ''; ?> required> Laki-laki
                                <input type="radio" name="jenkel" value="Perempuan" <?php echo ($jenis_kelamin == 'Perempuan') ? 'checked' : ''; ?> required> Perempuan <br>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir">Tanggal Lahir</label><br>
                                <input type="date" name="tanggal_lahir" value="<?php echo htmlspecialchars($tanggal_lahir); ?>" required><br>
                            </div> -->
                            <div class="mb-3">
                                <label for="pekerjaan">Pekerjaan</label><br>
                                <select name="pekerjaan" id="pekerjaan" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="Pelajar" <?php echo ($pekerjaan == 'Pelajar') ? 'selected' : ''; ?>>Pelajar</option>
                                    <option value="Mahasiswa" <?php echo ($pekerjaan == 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                                    <option value="Pegawai" <?php echo ($pekerjaan == 'Pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                    <option value="Lainnya" <?php echo ($pekerjaan == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Data Buku
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Reset Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    
    

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>