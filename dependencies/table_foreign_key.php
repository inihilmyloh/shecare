<?php

$sql = [
    "ALTER TABLE `shecare_native`.`penyakit` ADD FOREIGN KEY (`id_user`) REFERENCES `shecare_native`.`users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;",
    "ALTER TABLE `pertanyaan` ADD FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit`(`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;"
];

foreach($sql as $item) {
    if ($koneksi->query($item) === true) {
    } else {
        echo "Error: saat membuat tabel index foreign key!<br>";
    }
}

echo "Tabel index foreign key berhasil dibuat! <br>";