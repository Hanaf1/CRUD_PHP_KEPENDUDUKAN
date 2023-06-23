-- Membuat tabel penduduk
CREATE TABLE penduduk (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(50),
  alamat VARCHAR(100),
  pekerjaan VARCHAR(50)
);

-- Menambahkan data dummy ke tabel penduduk
INSERT INTO penduduk (nama, alamat, pekerjaan) VALUES
('John Doe', 'Jl. Merdeka No. 123', 'Pegawai Swasta'),
('Jane Smith', 'Jl. Sudirman No. 456', 'Wiraswasta'),
('Michael Johnson', 'Jl. Gatot Subroto No. 789', 'Dokter'),
('Emily Brown', 'Jl. Pahlawan No. 234', 'Guru'),
('Daniel Wilson', 'Jl. Diponegoro No. 567', 'Mahasiswa'),
('Olivia Davis', 'Jl. Veteran No. 890', 'Pengusaha'),
('David Miller', 'Jl. Imam Bonjol No. 123', 'PNS'),
('Sophia Martinez', 'Jl. Thamrin No. 456', 'Arsitek'),
('William Anderson', 'Jl. Asia Afrika No. 789', 'Penyanyi'),
('Ava Thomas', 'Jl. Cikini No. 234', 'Akuntan');
