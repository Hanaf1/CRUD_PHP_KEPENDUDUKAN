CREATE TABLE surat_keterangan_miskin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  alamat TEXT NOT NULL,
  pekerjaan VARCHAR(100) NOT NULL
);

INSERT INTO surat_keterangan_miskin (nama, alamat, pekerjaan) VALUES
  ('John Doe', 'Jl. Merdeka No. 123', 'Buruh'),
  ('Jane Smith', 'Jl. Pahlawan No. 456', 'Ibu Rumah Tangga'),
  ('Michael Johnson', 'Jl. Harapan Indah No. 789', 'Pegawai Swasta');
