-- ============================================================
--  MEMBUAT DATABASE PERPUSTAKAAN
-- ============================================================
CREATE DATABASE perpustakaan;

-- ============================================================
--  MEMBUAT TABEL ANGGOTA
-- ============================================================
CREATE TABLE anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    kode_anggota VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telepon VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    pekerjaan VARCHAR(50),
    tanggal_daftar DATE NOT NULL,
    status ENUM('Aktif', 'Nonaktif') DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
--  INSERT DATA ANGGOTA
-- ============================================================
INSERT INTO anggota (kode_anggota, nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, pekerjaan, tanggal_daftar, status) 
VALUES 
('AGT-001', 'Budi Santoso', 'budi.santoso@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '1995-05-15', 'Laki-laki', 'Mahasiswa', '2024-01-10', 'Aktif'),
 
('AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com', '081234567891', 'Jl. Sudirman No. 25, Bandung', '1998-08-20', 'Perempuan', 'Pegawai', '2024-01-15', 'Aktif'),
 
('AGT-003', 'Ahmad Dhani', 'ahmad.dhani@email.com', '081234567892', 'Jl. Gatot Subroto No. 5, Surabaya', '1992-03-10', 'Laki-laki', 'Pegawai', '2024-02-01', 'Aktif'),
 
('AGT-004', 'Dewi Lestari', 'dewi.lestari@email.com', '081234567893', 'Jl. Ahmad Yani No. 30, Yogyakarta', '2000-12-05', 'Perempuan', 'Mahasiswa', '2024-02-10', 'Aktif'),
 
('AGT-005', 'Rizky Febian', 'rizky.feb@email.com', '081234567894', 'Jl. Diponegoro No. 15, Semarang', '1997-07-18', 'Laki-laki', 'Pelajar', '2024-02-15', 'Nonaktif');

-- ============================================================
--  MEMBUAT TABEL TRANSAKSI
-- ============================================================
CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE,
    tanggal_harus_kembali DATE NOT NULL,
    status ENUM('Dipinjam', 'Dikembalikan', 'Terlambat') DEFAULT 'Dipinjam',
    denda DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku),
    FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
);

-- ============================================================
--  INSERT DATA TRANSAKSI
-- ============================================================
INSERT INTO transaksi (id_buku, id_anggota, tanggal_pinjam, tanggal_harus_kembali, status) 
VALUES 
(1, 1, '2024-02-01', '2024-02-08', 'Dipinjam'),
(2, 2, '2024-02-03', '2024-02-10', 'Dipinjam'),
(3, 1, '2024-01-25', '2024-02-01', 'Dikembalikan');

-- ============================================================
--  INSERT DATA TRANSAKSI
-- ============================================================
INSERT INTO transaksi (
    id_buku,
    id_anggota,
    tanggal_pinjam,
    tanggal_harus_kembali,
    tanggal_kembali,
    status,
    denda
)
VALUES
    (1, 1, '2026-03-01', '2026-03-15', '2026-03-14', 'Dikembalikan', 0.00),
    (2, 2, '2026-03-10', '2026-03-24', '2026-03-30', 'Terlambat',    30000.00),
    (3, 3, '2026-04-01', '2026-04-15', '2026-04-15', 'Dikembalikan', 0.00);

-- ============================================================
--  MEMBUAT TABEL KATEGORI BUKU
-- ============================================================
CREATE TABLE kategori_buku (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
--  INSERT DATA KATEGORI BUKU 
-- ============================================================
INSERT INTO kategori (nama_kategori, deskripsi) VALUES
('Fiksi',        'Karya sastra berupa cerita rekaan atau imajinatif'),
('Non-Fiksi',    'Karya berdasarkan fakta, ilmu pengetahuan, dan kenyataan'),
('Teknologi',    'Buku seputar komputer, pemrograman, dan teknologi informasi'),
('Sejarah',      'Buku yang membahas peristiwa dan tokoh bersejarah'),
('Pendidikan',   'Buku pelajaran dan referensi untuk kegiatan belajar-mengajar'),
('Bisnis',       'Buku tentang manajemen, kewirausahaan, dan ekonomi');

-- ============================================================
--  MEMBUAT TABEL PENERBIT
-- ============================================================
CREATE TABLE penerbit (
    id_penerbit INT AUTO_INCREMENT PRIMARY KEY,
    nama_penerbit VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
--  INSERT DATA PENERBIT  
-- ============================================================
INSERT INTO penerbit (nama_penerbit, kota, telepon, email) VALUES
('Gramedia Pustaka Utama',  'Jakarta',    '021-5300310', 'info@gramedia.com'),
('Erlangga',                'Jakarta',    '021-5782877', 'cs@erlangga.co.id'),
('Mizan Pustaka',           'Bandung',    '022-7012100', 'info@mizan.com'),
('Andi Offset',             'Yogyakarta', '0274-561881', 'info@andipublisher.com'),
('Bentang Pustaka',         'Yogyakarta', '0274-543800', 'redaksi@bentangpustaka.com'),
('Kompas Gramedia',         'Jakarta',    '021-5369660', 'info@kompas-gramedia.com');

-- ============================================================
--  MEMBUAT TABEL BUKU (disesuaikan dengan struktur aktual)
-- ============================================================
CREATE TABLE buku (
  id_buku      INT            PRIMARY KEY AUTO_INCREMENT,
  id_kategori  INT            NOT NULL,
  id_penerbit  INT            NOT NULL,
  kode_buku    VARCHAR(20)    NOT NULL,
  judul        VARCHAR(200)   NOT NULL,
  pengarang    VARCHAR(100)   NOT NULL,
  tahun_terbit INT(11)        NOT NULL,
  isbn         VARCHAR(20)    NULL,
  harga        DECIMAL(10,2)  NOT NULL,
  stok         INT(11)        NOT NULL DEFAULT 0,
  deskripsi    TEXT           NULL,
  created_at   TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori),
  FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit)
);

-- ============================================================
--  INSERT DATA BUKU
-- ============================================================
INSERT INTO buku (id_kategori, id_penerbit, kode_buku, judul, pengarang, tahun_terbit, isbn, harga, stok, deskripsi) VALUES
(1, 1, 'BK-001', 'Pemrograman PHP untuk Pemula', 'Budi Raharjo', '2022', '9786230011111', 85000, 15, 'Buku panduan dasar belajar PHP dari nol hingga mahir.'),
(2, 3, 'BK-002', 'Laskar Pelangi', 'Andrea Hirata', '2005', '9786230022222', 75000, 20, 'Kisah inspiratif 10 anak desa di Belitong yang berjuang meraih mimpi.'),
(3, 5, 'BK-003', 'Sejarah Nasional Indonesia', 'Sartono Kartodirdjo', '2018', '9786230033333', 120000, 8, 'Buku referensi lengkap mengenai sejarah bangsa Indonesia.'),
(4, 2, 'BK-004', 'Biologi Molekuler Dasar', 'Siti Maimunah', '2020', '9786230044444', 95000, 12, 'Pemahaman komprehensif mengenai sel dan biologi molekuler.'),
(5, 4, 'BK-005', 'Steve Jobs Biography', 'Walter Isaacson', '2011', '9786230055555', 150000, 5, 'Kisah hidup dan perjalanan karir pendiri Apple Inc.'),
(1, 2, 'BK-006', 'Mahir Jaringan Komputer', 'Melvin S.', '2023', '9786230066666', 90000, 18, 'Membahas topologi, protokol, dan keamanan jaringan secara praktis.'),
(2, 4, 'BK-007', 'Bumi Manusia', 'Pramoedya Ananta Toer', '1980', '9786230077777', 110000, 10, 'Novel berlatar belakang era kolonial Belanda menceritakan tokoh Minke.'),
(3, 1, 'BK-008', 'Sapiens: Riwayat Singkat Umat Manusia', 'Yuval Noah Harari', '2014', '9786230088888', 135000, 25, 'Menelusuri sejarah evolusi manusia dari zaman batu hingga abad ke-21.'),
(4, 3, 'BK-009', 'Kalkulus Lanjut', 'Edwin J. Purcell', '2019', '9786230099999', 180000, 4, 'Buku teks standar universitas untuk mata kuliah kalkulus tingkat lanjut.'),
(5, 5, 'BK-010', 'Soekarno: Bapak Bangsa', 'Bob Hering', '2003', '9786230101010', 125000, 7, 'Biografi mendalam tentang presiden pertama Republik Indonesia.'),
(1, 4, 'BK-011', 'Algoritma dan Struktur Data', 'Rinaldi Munir', '2016', '9786230111111', 115000, 22, 'Fundamental ilmu komputer yang wajib dikuasai oleh programmer.'),
(2, 1, 'BK-012', 'Cantik Itu Luka', 'Eka Kurniawan', '2002', '9786230121212', 98000, 14, 'Karya fiksi surealis yang menggabungkan sejarah, mitos, dan tragedi.'),
(3, 2, 'BK-013', 'Guns, Germs, and Steel', 'Jared Diamond', '1997', '9786230131313', 145000, 9, 'Menjawab mengapa peradaban Eurasia mendominasi dunia.'),
(4, 5, 'BK-014', 'Fisika Kuantum untuk Mahasiswa', 'Yohanes Surya', '2015', '9786230141414', 105000, 11, 'Pengantar fisika modern dengan penjelasan yang lebih mudah dipahami.'),
(5, 3, 'BK-015', 'Habibie & Ainun', 'B.J. Habibie', '2010', '9786230151515', 85000, 30, 'Kisah cinta sejati dan dedikasi B.J. Habibie untuk istri dan negaranya.');

-- ============================================================
--  JOIN untuk tampilkan buku dengan nama kategori dan penerbit  
-- ============================================================
SELECT
    b.id_buku,
    b.kode_buku,
    b.judul,
    b.pengarang,
    b.tahun_terbit,
    b.isbn,
    b.harga,
    b.stok,
    k.nama_kategori,
    p.nama_penerbit
FROM buku b
INNER JOIN kategori_buku k
    ON b.id_kategori = k.id_kategori
INNER JOIN penerbit p
    ON b.id_penerbit = p.id_penerbit
ORDER BY b.judul ASC;

-- ============================================================
--  Jumlah buku per kategori  
-- ============================================================
SELECT
    k.id_kategori,
    k.nama_kategori,
    COUNT(b.id_buku) AS jumlah_buku
FROM kategori_buku k
LEFT JOIN buku b
    ON k.id_kategori = b.id_kategori
GROUP BY
    k.id_kategori,
    k.nama_kategori
ORDER BY jumlah_buku DESC;

-- ============================================================
--  Jumlah buku per penerbit  
-- ============================================================
SELECT
    p.id_penerbit,
    p.nama_penerbit,
    p.telepon,
    p.email,
    COUNT(b.id_buku) AS jumlah_buku
FROM penerbit p
LEFT JOIN buku b
    ON p.id_penerbit = b.id_penerbit
GROUP BY
    p.id_penerbit,
    p.nama_penerbit,
    p.telepon,
    p.email
ORDER BY jumlah_buku DESC;

-- ============================================================
--  Detail lengkap buku (kategori + penerbit)  
-- ============================================================
SELECT
    b.id_buku,
    b.kode_buku,
    b.judul,
    b.pengarang,
    b.tahun_terbit,
    b.isbn,
    b.harga,
    b.stok,
    b.deskripsi,
    -- Detail kategori
    k.id_kategori,
    k.nama_kategori,
    k.deskripsi   AS deskripsi_kategori,
    -- Detail penerbit
    p.id_penerbit,
    p.nama_penerbit,
    p.alamat       AS alamat_penerbit,
    p.telepon      AS telepon_penerbit,
    p.email        AS email_penerbit
FROM buku b
INNER JOIN kategori_buku k
    ON b.id_kategori = k.id_kategori
INNER JOIN penerbit p
    ON b.id_penerbit = p.id_penerbit
ORDER BY
    k.nama_kategori ASC,
    b.judul         ASC;