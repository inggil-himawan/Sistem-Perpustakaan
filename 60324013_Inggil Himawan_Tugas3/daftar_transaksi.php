<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>
        
        <?php
        // TODO: Hitung statistik dengan loop
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // Loop pertama untuk hitung statistik yang HANYA ditampilkan
        for ($i = 1; $i <= 10; $i++) {
            // Stop di transaksi 8
            if ($i == 8) {
                break; 
            }
            // Skip transaksi genap
            if ($i % 2 == 0) {
                continue; 
            }

            $total_transaksi++;
            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
            
            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Total Ditampilkan</h5>
                    </div>
                    <div class="card-body">
                        <h3><?php echo $total_transaksi; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Masih Dipinjam</h5>
                    </div>
                    <div class="card-body">
                        <h3><?php echo $total_dipinjam; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Sudah Dikembalikan</h5>
                    </div>
                    <div class="card-body">
                        <h3><?php echo $total_dikembalikan; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th>ID Transaksi</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Lama Pinjam</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hari_ini = new DateTime();

                    // Nomor urut tabel
                    $nomor_urut = 1;

                    // Loop untuk tampilkan data
                    for ($i = 1; $i <= 10; $i++) {
                        
                        // 1. Gunakan break untuk stop di transaksi 8
                        if ($i == 8) {
                            break;
                        }

                        // 2. Gunakan continue untuk skip genap
                        if ($i % 2 == 0) {
                            continue;
                        }

                        // Generate data transaksi
                        $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                        $nama_peminjam = "Anggota " . $i;
                        $judul_buku = "Buku Teknologi Vol. " . $i;
                        $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                        $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                        
                        // Menghitung jumlah hari sejak pinjam (Hari ini - Tanggal Pinjam)
                        $pinjam_dt = new DateTime($tanggal_pinjam);
                        $selisih_hari = $hari_ini->diff($pinjam_dt)->days;

                        // Tentukan status
                        $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
                        
                        // Style badge menggunakan class Bootstrap
                        if ($status == "Dikembalikan") {
                            $badge = "<span class='badge bg-success'>Dikembalikan</span>";
                        } else {
                            $badge = "<span class='badge bg-warning text-dark'>Dipinjam</span>";
                        }
                        
                        // Tampilkan data dalam tabel
                        echo "<tr>
                                <td class='text-center'>{$nomor_urut}</td>
                                <td>{$id_transaksi}</td>
                                <td>{$nama_peminjam}</td>
                                <td>{$judul_buku}</td>
                                <td>{$tanggal_pinjam}</td>
                                <td>{$tanggal_kembali}</td>
                                <td>{$selisih_hari} Hari</td>
                                <td class='text-center'>{$badge}</td>
                              </tr>";
                        
                        $nomor_urut++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>