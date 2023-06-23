-- Struktur Tabel
CREATE TABLE pengajuan_surat_domisili (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(50),
  alamat_lama VARCHAR(100),
  alamat_baru VARCHAR(100),
  alasan TEXT
);

-- Data Dummy
INSERT INTO pengajuan_surat_domisili (nama, alamat_lama, alamat_baru, alasan) VALUES
('John Doe', 'Jl. Lama No. 123', 'Jl. Baru No. 456', 'Alasan pindah: ........'),
('Jane Smith', 'Jl. Sebelumnya No. 789', 'Jl. Sekarang No. 987', 'Alasan pindah: ........');
