```php
<?php

// Hostname or IP of server
$servername = "localhost";

// Username and password
$dbusername = "root";
$dbpassword = "";

// Connect to server
$link = mysqli_connect($servername, $dbusername, $dbpassword, "db_sekolah", 3306)
    or die("Not able to connect to server: " . mysqli_connect_error());

if ($link) {
    echo "OK.... koneksi berhasil";
}

?>
```