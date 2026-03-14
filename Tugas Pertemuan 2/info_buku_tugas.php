<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Informasi Buku</h1>
        
        <?php
            // Data buku
            $judul = "Laravel: From Beginner to Advanced";
            $pengarang = "Budi Raharjo";
            $penerbit = "Informatika";
            $tahun_terbit = 2023;
            $harga = 125000;
            $stok = 8;
            $isbn = "978-602-1234-56-7";

            // Buku 2
            $judul2 = "Mastering PostgreSQL 15";
            $pengarang2 = "Hans-Jürgen Schönig";
            $penerbit2 = "Packt Publishing";
            $tahun_terbit2 = 2022;
            $isbn2 = "978-1-803-24751-2";
            $harga2 = 450000;
            $stok2 = 12;
            $kategori_buku2 = "Database";
            $bahasa2 = "Inggris";
            $halaman2 = 520;
            $berat2 = 600;

            // Buku 3
            $judul3 = "Modern UI/UX Web Design";
            $pengarang3 = "Wahyu Pratama";
            $penerbit3 = "Elex Media Komputindo";
            $tahun_terbit3 = 2024;
            $isbn3 = "978-623-00-1122-3";
            $harga3 = 95000;
            $stok3 = 25;
            $kategori_buku3 = "Web Design";
            $bahasa3 = "Indonesia";
            $halaman3 = 210;
            $berat3 = 300;

            // Buku 4
            $judul4 = "Python Crash Course, 3rd Edition";
            $pengarang4 = "Eric Matthes";
            $penerbit4 = "No Starch Press";
            $tahun_terbit4 = 2023;
            $isbn4 = "978-1-593-27928-8";
            $harga4 = 550000;
            $stok4 = 5;
            $kategori_buku4 = "Programming";
            $bahasa4 = "Inggris";
            $halaman4 = 552;
            $berat4 = 850;
        ?>
        
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul; ?></h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok; ?> buku</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul2; ?></h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang2; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit2; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit2; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn2; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga2, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok2; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td>: <?php echo $kategori_buku2; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa2; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman2; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat2; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul3; ?></h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang3; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit3; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit3; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn3; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga3, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok3; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td>: <?php echo $kategori_buku3; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa3; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman3; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat3; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul4; ?></h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang4; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit4; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit4; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn4; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga4, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok4; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td>: <?php echo $kategori_buku4; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa4; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman4; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat4; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>