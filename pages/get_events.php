<?php
session_start();
@include '../config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['NamaDepan'])) {
    echo json_encode(["message" => "Unauthorized access."]);
    exit();
}

// Query untuk mengambil data acara dari database
$query = "SELECT * FROM acara";
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil
if ($result) {
    $events = [];
    
    // Mengambil data acara dan memasukkan ke array $events
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }

    // Mengembalikan data acara dalam format JSON
    echo json_encode($events);
} else {
    // Jika query gagal, kembalikan pesan error dalam format JSON
    echo json_encode(["message" => "Failed to fetch events."]);
}

mysqli_close($conn);
?>
