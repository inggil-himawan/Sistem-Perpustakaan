<?php
session_start();

// 1. Data Buku (Array 10+ Data)
$buku_list = [
        // TODO: Isi dengan 10+ data buku
    [
        "kode" => "BK-001",
        "judul" => "Pemrograman PHP untuk Pemula",
        "kategori" => "Programming",
        "pengarang" => "Budi Raharjo",
        "penerbit" => "Informatika",
        "tahun" => 2023,
        "harga" => 75000,
        "stok" => 10
    ],
    [
        "kode" => "BK-002",
        "judul" => "Mastering MySQL Database",
        "kategori" => "Database",
        "pengarang" => "Andi Nugroho",
        "penerbit" => "Graha Ilmu",
        "tahun" => 2022,
        "harga" => 95000,
        "stok" => 5
    ],
    [
        "kode" => "BK-003",
        "judul" => "Laravel Framework Advanced",
        "kategori" => "Programming",
        "pengarang" => "Siti Aminah",
        "penerbit" => "Informatika",
        "tahun" => 2024,
        "harga" => 125000,
        "stok" => 8
    ],
    [
        "kode" => "BK-004",
        "judul" => "Web Design Principles",
        "kategori" => "Web Design",
        "pengarang" => "Dedi Santoso",
        "penerbit" => "Andi",
        "tahun" => 2023,
        "harga" => 85000,
        "stok" => 15
    ],
    [
        "kode" => "BK-005",
        "judul" => "Network Security Fundamentals",
        "kategori" => "Networking",
        "pengarang" => "Rina Wijaya",
        "penerbit" => "Erlangga",
        "tahun" => 2023,
        "harga" => 110000,
        "stok" => 3
    ],
    [
        "kode" => "BK-006",
        "judul" => "PHP Web Services",
        "kategori" => "Programming",
        "pengarang" => "Budi Raharjo",
        "penerbit" => "Informatika",
        "tahun" => 2024,
        "harga" => 90000,
        "stok" => 12
    ],
    [
        "kode" => "BK-007",
        "judul" => "PostgreSQL Advanced",
        "kategori" => "Database",
        "pengarang" => "Ahmad Yani",
        "penerbit" => "Graha Ilmu",
        "tahun" => 2024,
        "harga" => 115000,
        "stok" => 7
    ],
    [
        "kode" => "BK-008",
        "judul" => "JavaScript Modern",
        "kategori" => "Programming",
        "pengarang" => "Siti Aminah",
        "penerbit" => "Informatika",
        "tahun" => 2023,
        "harga" => 80000,
        "stok" => 0
    ],
    [
        "kode" => "BK-009",
        "judul" => "Data Science dengan Python",
        "kategori" => "Data Science",
        "pengarang" => "Ayu Lestari",
        "penerbit" => "Elex Media Komputindo",
        "tahun" => 2024,
        "harga" => 135000,
        "stok" => 25
    ],
    [
        "kode" => "BK-010",
        "judul" => "Belajar React JS dari Nol",
        "kategori" => "Web Design",
        "pengarang" => "Hendra Pratama",
        "penerbit" => "Andi",
        "tahun" => 2023,
        "harga" => 105000,
        "stok" => 14
    ],
    [
        "kode" => "BK-011",
        "judul" => "Algoritma dan Struktur Data",
        "kategori" => "Programming",
        "pengarang" => "Rinaldi Munir",
        "penerbit" => "Informatika",
        "tahun" => 2022,
        "harga" => 145000,
        "stok" => 6
    ],
    [
        "kode" => "BK-012",
        "judul" => "Cyber Security for Business",
        "kategori" => "Networking",
        "pengarang" => "Onno W. Purbo",
        "penerbit" => "Elex Media Komputindo",
        "tahun" => 2024,
        "harga" => 120000,
        "stok" => 0
    ],
    [
        "kode" => "BK-013",
        "judul" => "UI/UX Design Essentials",
        "kategori" => "Web Design",
        "pengarang" => "Kevin Kurniawan",
        "penerbit" => "Andi",
        "tahun" => 2023,
        "harga" => 95000,
        "stok" => 20
    ],
    [
        "kode" => "BK-014",
        "judul" => "Machine Learning Dasar",
        "kategori" => "Data Science",
        "pengarang" => "Taufik Hidayat",
        "penerbit" => "Graha Ilmu",
        "tahun" => 2024,
        "harga" => 155000,
        "stok" => 4
    ],
    [
        "kode" => "BK-015",
        "judul" => "Docker dan Kubernetes",
        "kategori" => "Programming",
        "pengarang" => "Bambang Sugiantoro",
        "penerbit" => "Informatika",
        "tahun" => 2023,
        "harga" => 130000,
        "stok" => 9
    ]
];

// 2. Ambil Parameter GET
$keyword    = $_GET['keyword'] ?? '';
$kategori   = $_GET['kategori'] ?? '';
$min_harga  = $_GET['min_harga'] ?? '';
$max_harga  = $_GET['max_harga'] ?? '';
$tahun_param = $_GET['tahun'] ?? '';
$status     = $_GET['status'] ?? 'semua';
$sort       = $_GET['sort'] ?? 'judul';
$page       = (int)($_GET['page'] ?? 1);
$per_page   = 10;

// 3. Validasi
$errors = [];
$current_year = date("Y");

if (!empty($min_harga) && !empty($max_harga) && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum.";
}
if (!empty($tahun_param) && ($tahun_param < 1900 || $tahun_param > $current_year)) {
    $errors[] = "Tahun harus di antara 1900 sampai $current_year.";
}

// 4. Logika Filter
$hasil = [];
if (empty($errors)) {
    foreach ($buku_list as $buku) {
        // Filter Keyword (Judul atau Pengarang)
        if (!empty($keyword) && stripos($buku['judul'], $keyword) === false && stripos($buku['pengarang'], $keyword) === false) continue;
        
        // Filter Kategori
        if (!empty($kategori) && $buku['kategori'] !== $kategori) continue;
        
        // Filter Harga
        if (!empty($min_harga) && $buku['harga'] < $min_harga) continue;
        if (!empty($max_harga) && $buku['harga'] > $max_harga) continue;
        
        // Filter Tahun
        if (!empty($tahun_param) && $buku['tahun'] != $tahun_param) continue;
        
        // Filter Status
        if ($status === 'tersedia' && $buku['stok'] <= 0) continue;
        if ($status === 'habis' && $buku['stok'] > 0) continue;
        
        $hasil[] = $buku;
    }

    // Recent Search (Bonus)
    if (!empty($keyword)) {
        if (!isset($_SESSION['recent'])) $_SESSION['recent'] = [];
        if (!in_array($keyword, $_SESSION['recent'])) {
            array_unshift($_SESSION['recent'], $keyword);
            $_SESSION['recent'] = array_slice($_SESSION['recent'], 0, 5);
        }
    }
}

// 5. Sorting
usort($hasil, function($a, $b) use ($sort) {
    if ($sort == 'harga' || $sort == 'tahun') {
        return $a[$sort] <=> $b[$sort];
    }
    return strcasecmp($a[$sort], $b[$sort]);
});

// 6. CSV Export Logic (Bonus)
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="hasil_pencarian.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Kode', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun', 'Harga', 'Stok']);
    foreach ($hasil as $row) fputcsv($output, $row);
    fclose($output);
    exit;
}

// 7. Pagination
$total_hasil = count($hasil);
$total_pages = ceil($total_hasil / $per_page);
$offset = ($page - 1) * $per_page;
$hasil_paginated = array_slice($hasil, $offset, $per_page);

// Helper: Highlight Keyword (Bonus)
function highlight($text, $search) {
    if (empty($search)) return $text;
    return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark class="p-0">$1</mark>', $text);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencarian Buku Advanced</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Sistem Pencarian Buku</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Judul atau pengarang..." value="<?= htmlspecialchars($keyword) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <?php 
                            $kats = array_unique(array_column($buku_list, 'kategori'));
                            foreach ($kats as $kat): ?>
                                <option value="<?= $kat ?>" <?= $kategori == $kat ? 'selected' : '' ?>><?= $kat ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-select">
                            <option value="judul" <?= $sort == 'judul' ? 'selected' : '' ?>>Judul (A-Z)</option>
                            <option value="harga" <?= $sort == 'harga' ? 'selected' : '' ?>>Harga Termurah</option>
                            <option value="tahun" <?= $sort == 'tahun' ? 'selected' : '' ?>>Tahun Terlama</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" placeholder="YYYY" value="<?= htmlspecialchars($tahun_param) ?>">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Harga Min</label>
                        <input type="number" name="min_harga" class="form-control" value="<?= htmlspecialchars($min_harga) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga Max</label>
                        <input type="number" name="max_harga" class="form-control" value="<?= htmlspecialchars($max_harga) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block">Status Ketersediaan</label>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="status" value="semua" <?= $status == 'semua' ? 'checked' : '' ?>> Semua
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="tersedia" <?= $status == 'tersedia' ? 'checked' : '' ?>> Tersedia
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="habis" <?= $status == 'habis' ? 'checked' : '' ?>> Habis
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Cari Buku</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['recent'])): ?>
        <div class="mb-3">
            <small class="text-muted">Pencarian terakhir: </small>
            <?php foreach($_SESSION['recent'] as $r): ?>
                <a href="?keyword=<?= urlencode($r) ?>" class="badge bg-secondary text-decoration-none"><?= htmlspecialchars($r) ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Ditemukan: <span class="badge bg-info"><?= $total_hasil ?> Buku</span></h5>
        <?php if ($total_hasil > 0): ?>
            <a href="?<?= $_SERVER['QUERY_STRING'] ?>&export=csv" class="btn btn-success btn-sm">Export CSV</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $nomor = 1;
                    if ($total_hasil > 0): 
                    foreach ($hasil_paginated as $b): 
                ?>
                <tr>
                    <td><?php echo $nomor++ ?></td>
                    <td><?= $b['kode'] ?></td>
                    <td class="fw-bold"><?= highlight($b['judul'], $keyword) ?></td>
                    <td><?= highlight($b['pengarang'], $keyword) ?></td>
                    <td><span class="badge bg-light text-dark border"><?= $b['kategori'] ?></span></td>
                    <td><?= $b['tahun'] ?></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($b['stok'] > 0): ?>
                            <span class="badge bg-success"><?= $b['stok'] ?></span>
                        <?php else: ?>
                            <span class="badge bg-danger">Habis</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-4">Data tidak ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($total_pages > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
</body>
</html>