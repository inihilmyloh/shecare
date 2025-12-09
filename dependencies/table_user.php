<?php

$nama_tabel = "users";

$sql = "
    CREATE TABLE `$nama_tabel` (
    `id_user` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nama_user` varchar(255) ,
    `alamat` varchar(255) ,
    `no_telp` char(15) ,
    `email` varchar(255) ,
    `password` varchar(255) ,
    `role` enum('admin','user','karyawan') NOT NULL,
    `cara_tercatat` enum('mendaftar', 'didaftarkan') NOT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
    )
";

if ($koneksi->query($sql) === true) {
    echo "Tabel dibuat!: $nama_tabel <br>";
} else {
    echo "Error: saat membuat tabel $nama_tabel<br>";
}

$sql = "
    INSERT INTO `users` (`id_user`, `nama_user`, `alamat`, `no_telp`, `email`, `password`, `role`, `created_at`, `updated_at`, `cara_tercatat`) VALUES
    (1, 'Mahayoga', 'Probolinggo', '081234567890', 'myoga.bahtiar@gmail.com', '$2y$12\$x4mOtUHmIyw.GY9E2QmAouX6Wo5C1ibKHON9yZJPKBCNFzQEkfq2y', 'admin', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'mendaftar'),
    (2, 'Irsyad', 'Gresik', '081234567891', 'syadd@gmail.com', '$2y$12$2eTYQYN5t36xQVuTCO/fLe.U9BnaU7Bko4hRytcojTKwHmf5YQA8K', 'admin', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'mendaftar'),
    (3, 'Nisa', 'Banyuwangi', '081234567892', 'nisa@gmail.com', '$2y$12$4UEdFSnLaVGRgXGLFXV9JuHqO8XOEw659Lya.QBJoTOFrBbMCrBGS', 'admin', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'mendaftar'),
    (4, 'Citra', 'Jember', '081234567893', 'citra@gmail.com', '$2y$12\$Z6i8HOhUO3MCABZdB598Ne0h8aYbJnGJeN8Qa6u2TCknVl0E/GcHW', 'admin', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'mendaftar'),
    (5, 'Fila', 'Probolinggo', '081234567894', 'fila@gmail.com', '$2y$12\$HcTHEPYmVdtG5Cys2VsJkOuf.oHqGHtesFr2VrBkAqA/6D0SKa5Wi', 'admin', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'mendaftar'),
    (6, 'User Test', 'Jakarta', '081234567895', 'user@gmail.com', '$2y$12\$E8LIl.8HKaLfeSI9FiyRG.OmxBoM0.MATGFakIuI.kHxHNNAx76hC', 'user', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'didaftarkan'),
    (7, 'Mahayoga', 'Probolinggo', '081234567896', 'myoga.bhtr@gmail.com', ' $2a$12\$z8Pm9IOgLsPXcG8tb9pSJ.3Rc5qShGbasu0ytmqoVCRP5NG4LPKkG ', 'karyawan', '2024-12-06 02:28:56', '2024-12-06 02:27:57', 'didaftarkan'),
    (8, 'Abyasa', 'Jember', '081234567896', 'Abyasa@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (9, 'Adhiarja', 'Jember', '081234567896', 'Adhiarja@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (10, 'Adika', 'Jember', '081234567896', 'Adika@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (11, 'Aditya', 'Jember', '081234567896', 'Aditya@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (12, 'Agung', 'Jember', '081234567896', 'Agung@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (13, 'Ahmad', 'Jember', '081234567896', 'Ahmad@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (14, 'Ajij', 'Jember', '081234567896', 'Ajij@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (15, 'Angga ', 'Jember', '081234567896', 'Angga @gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (16, 'Arief', 'Jember', '081234567896', 'Arief@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (17, 'Arif', 'Jember', '081234567896', 'Arif@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (18, 'Bagaskoro', 'Jember', '081234567896', 'Bagaskoro@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (19, 'Bagus', 'Jember', '081234567896', 'Bagus@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (20, 'Bakti', 'Jember', '081234567896', 'Bakti@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (21, 'Banyu', 'Jember', '081234567896', 'Banyu@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (22, 'Baskoro', 'Jember', '081234567896', 'Baskoro@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (23, 'Basuki', 'Jember', '081234567896', 'Basuki@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (24, 'Batara', 'Jember', '081234567896', 'Batara@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (25, 'Berkah', 'Jember', '081234567896', 'Berkah@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (26, 'Bima', 'Jember', '081234567896', 'Bima@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (27, 'Bimo', 'Jember', '081234567896', 'Bimo@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (28, 'Bintang', 'Jember', '081234567896', 'Bintang@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (29, 'Budi', 'Jember', '081234567896', 'Budi@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (30, 'Cahya', 'Jember', '081234567896', 'Cahya@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (31, 'Cahyono', 'Jember', '081234567896', 'Cahyono@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (32, 'Chahaya', 'Jember', '081234567896', 'Chahaya@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (33, 'Cipta', 'Jember', '081234567896', 'Cipta@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (34, 'Darma', 'Jember', '081234567896', 'Darma@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (35, 'Dumadi', 'Jember', '081234567896', 'Dumadi@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (36, 'Eas', 'Jember', '081234567896', 'Eas@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (37, 'Eka', 'Jember', '081234567896', 'Eka@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (38, 'Elang', 'Jember', '081234567896', 'Elang@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (39, 'Fadhlan', 'Jember', '081234567896', 'Fadhlan@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (40, 'Farrel', 'Jember', '081234567896', 'Farrel@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (41, 'Galang', 'Jember', '081234567896', 'Galang@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (42, 'Gemi', 'Jember', '081234567896', 'Gemi@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (43, 'Gesang', 'Jember', '081234567896', 'Gesang@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (44, 'Gunadi', 'Jember', '081234567896', 'Gunadi@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (45, 'Guss', 'Jember', '081234567896', 'Guss@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (46, 'Harta', 'Jember', '081234567896', 'Harta@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (47, 'Harto', 'Jember', '081234567896', 'Harto@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (48, 'Intan', 'Jember', '081234567896', 'Intan@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (49, 'Ismaya', 'Jember', '081234567896', 'Ismaya@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (50, 'Joyo', 'Jember', '081234567896', 'Joyo@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (51, 'Kabul', 'Jember', '081234567896', 'Kabul@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (52, 'Kristiono', 'Jember', '081234567896', 'Kristiono@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (53, 'Kaliappa', 'Jember', '081234567896', 'Kaliappa@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (54, 'Kersen', 'Jember', '081234567896', 'Kersen@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (55, 'Mego', 'Jember', '081234567896', 'Mego@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (56, 'Panuta', 'Jember', '081234567896', 'Panuta@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (57, 'Pramana', 'Jember', '081234567896', 'Pramana@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (58, 'Pratam', 'Jember', '081234567896', 'Pratam@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (59, 'Putra', 'Jember', '081234567896', 'Putra@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (60, 'Perdana', 'Jember', '081234567896', 'Perdana@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (61, 'Reza', 'Jember', '081234567896', 'Reza@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (62, 'Rimbo', 'Jember', '081234567896', 'Rimbo@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (63, 'Ramelan', 'Jember', '081234567896', 'Ramelan@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (64, 'Rimba', 'Jember', '081234567896', 'Rimba@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (65, 'Setiawan', 'Jember', '081234567896', 'Setiawan@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (66, 'Soleh', 'Jember', '081234567896', 'Soleh@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (67, 'Susila', 'Jember', '081234567896', 'Susila@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (68, 'Santoso', 'Jember', '081234567896', 'Santoso@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (69, 'Stanley', 'Jember', '081234567896', 'Stanley@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (70, 'Timur', 'Jember', '081234567896', 'Timur@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar'),
    (71, 'Taman', 'Jember', '081234567896', 'Taman@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (72, 'Vikal', 'Jember', '081234567896', 'Vikal@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'didaftarkan'),
    (73, 'Yuda', 'Jember', '081234567896', 'Yuda@gmail.com', '$2a$12\$aN/Y9PEpcuhz5eyVVFwVY.GZ79jA.CxfHDqJ8cMiXr2Q3jMsH2I4q', 'user', null, null, 'mendaftar');
";

if ($koneksi->query($sql) === true) {
    echo "Seeder dibuat!: $nama_tabel <br>";
} else {
    echo "Error: saat membuat seeder $nama_tabel<br>";
}