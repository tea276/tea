#!/bin/bash

# Path lengkap ke script PHP Anda
PHP_SCRIPT="/home/staiat/public_html/uay.php"

# Nama proses parent yang konsisten
PROCESS_NAME="server_staiat_grep"

# Fungsi untuk menjalankan script PHP
start_php_script() {
    php "$PHP_SCRIPT" &
    echo "Memulai script PHP: $PHP_SCRIPT dengan PID $!"
}

# Jalankan script PHP pertama kali
start_php_script

# Loop pengawasan
while true; do
    # Cek apakah process parent masih berjalan
    if ! pgrep -f "$PROCESS_NAME" > /dev/null; then
        echo "$(date): Process $PROCESS_NAME tidak berjalan. Restart dalam 5 detik..."
        sleep 5
        start_php_script
    fi
    # Tunggu sebelum pengecekan berikutnya
    sleep 1
done
