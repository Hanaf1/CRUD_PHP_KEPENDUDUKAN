-- Membuat tabel data_bansos
CREATE TABLE data_bansos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(50),
  alamat VARCHAR(100),
  jenis_bansos VARCHAR(50),
  total_dana_bansos DECIMAL(10,2)
);

-- Menambahkan data ke tabel data_bansos
INSERT INTO data_bansos (nama, alamat, jenis_bansos, total_dana_bansos) VALUES
('John Doe', 'Jl. Merdeka No. 123', 'Bantuan Sosial Tunai', 1000000.00),
('Jane Smith', 'Jl. Raya Maju No. 456', 'Bantuan Pangan', 1500000.00),
('Michael Johnson', 'Jl. Jendral Sudirman No. 789', 'Bantuan Sembako', 800000.00),
('Emily Davis', 'Jl. Diponegoro No. 101', 'Bantuan Langsung Tunai', 500000.00),
('Robert Wilson', 'Jl. Imam Bonjol No. 202', 'Bantuan Pendidikan', 1200000.00),
('Olivia Brown', 'Jl. Gatot Subroto No. 303', 'Bantuan Kesehatan', 900000.00),
('William Taylor', 'Jl. Thamrin No. 404', 'Bantuan Sosial Non-Tunai', 700000.00),
('Sophia Anderson', 'Jl. Veteran No. 505', 'Bantuan Produktif Usaha Mikro', 600000.00),
('Jacob Thomas', 'Jl. Ahmad Yani No. 606', 'Bantuan Modal Usaha', 1000000.00),
('Mia Martinez', 'Jl. Hayam Wuruk No. 707', 'Bantuan Pemulihan Ekonomi', 800000.00);


