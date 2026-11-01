DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE penjualan;
USE penjualan;

CREATE TABLE supplier (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  telp VARCHAR(12) NOT NULL,
  alamat TEXT NOT NULL
);

CREATE TABLE barang (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10) NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga INT(11) NOT NULL,
  stok INT(11) NOT NULL,
  supplier_id INT(11) NULL,
  FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL
);

CREATE TABLE pelanggan (
  id VARCHAR(20) NOT NULL PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp VARCHAR(12) NOT NULL,
  alamat TEXT NOT NULL
);

CREATE TABLE transaksi (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATE NOT NULL,
  keterangan TEXT,
  total INT(11) NOT NULL,
  pelanggan_id VARCHAR(20) NOT NULL,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
  transaksi_id INT(11) NOT NULL,
  barang_id INT(11) NOT NULL,
  harga INT(11) NOT NULL,
  qty INT(11) NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
  FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar DATETIME NOT NULL,
  total INT(11) NOT NULL,
  metode ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT(11) NOT NULL,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
  id_user TINYINT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(35) NOT NULL,
  nama VARCHAR(50) NOT NULL,
  alamat VARCHAR(150) NOT NULL,
  hp VARCHAR(20) NOT NULL,
  level TINYINT(1) NOT NULL
);

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama','08123456','Surabaya'),
('PT. Senang Sekali','081515563','Bangkalan'),
('PT. Segar Segar','0845454663','Surabaya'),
('PT. Sumber Rejeki','081234567890','Sidoarjo'),
('PT. Abadi Jaya','082134567811','Gresik'),
('PT. Berkah Makmur','085234567822','Malang'),
('PT. Sinar Utama','081345678933','Surabaya'),
('PT. Cipta Niaga','087856789044','Madiun'),
('PT. Tani Sejahtera','081956789055','Kediri'),
('PT. Mitra Pangan','082256789066','Bangkalan');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001','Beras 5 kg',65000,50,1),
('BRG002','Minyak Goreng 2 L',34000,40,2),
('BRG003','Gula Pasir 1 kg',16000,60,3),
('BRG004','Telur Ayam 1 kg',28000,30,4),
('BRG005','Kopi Bubuk 200 g',18000,45,5),
('BRG006','Teh Celup 25 pcs',9000,70,6),
('BRG007','Susu UHT 1 L',7500,80,7),
('BRG008','Mie Instan',3500,200,8),
('BRG009','Sabun Mandi',12000,55,9),
('BRG010','Sirup 500 ml',21000,35,10);

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin',MD5('admin123'),'Administrator','Surabaya','081000000001',1),
('kasir1',MD5('kasir123'),'Kasir Satu','Sidoarjo','081000000002',2),
('kasir2',MD5('kasir123'),'Kasir Dua','Gresik','081000000003',2),
('kasir3',MD5('kasir123'),'Kasir Tiga','Bangkalan','081000000004',2),
('gudang1',MD5('gudang123'),'Staf Gudang Satu','Surabaya','081000000005',3),
('gudang2',MD5('gudang123'),'Staf Gudang Dua','Malang','081000000006',3),
('owner',MD5('owner123'),'Pemilik Toko','Surabaya','081000000007',1),
('manajer',MD5('manajer123'),'Manajer Toko','Madiun','081000000008',1),
('kasir4',MD5('kasir123'),'Kasir Empat','Kediri','081000000009',2),
('kasir5',MD5('kasir123'),'Kasir Lima','Sidoarjo','081000000010',2);
