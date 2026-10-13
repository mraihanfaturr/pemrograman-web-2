<html>
<head>
<title>Penggunaan Switch - Case</title>
</head>
<body>

Hari ini :
<?php
$nama_hari = date("l");

switch ($nama_hari)
{
    case "Sunday":
        print("Minggu");
        print "Waktu untuk istirahat";
        break;

    case "Monday":
        Print("Senin <br>");
        print "Meeting awal minggu jam 08.00";
        break;

    case "Tuesday":
        Print("Selasa <br>");
        print "Pembukaan Workshop Diklat";
        break;

    case "Wednesday":
        Print("Rabu <br>");
        print("Seminar Launching Window Vista di JHCC");
        break;

    case "Thursday":
        Print("Kamis <br>");
        print "Pertemuan dengan Mahasiswa";
        break;

    case "Friday":
        Print("Jum'at <br>");
        print "Jogging bersama";
        break;

    Default:
        Print("Sabtu <br>");
        print "Survey harga ke Dusit, Mangga Dua";
}
?>
</body>
</html>