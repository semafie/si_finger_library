<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            max-height: 100vh;
            margin: 0;
            height: 100vh;
            background-color: #0a2d5d;
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container {
            text-align: center;
            
        }

        .container p{
            font-size: 35px;
        }

        .container img{
            width: 200px;
        }

        input[type="text"] {
            width: 500px;
            padding: 15px 15px;
            margin: 20px 0;
            margin-right: 15px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)
        }
        .container button {
            padding: 15px 50px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(135deg, #01265A, #345785, #5381B2);
            color: #fff;
            cursor: pointer;
            font-size: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)
        }

        .container button:hover{
            background: linear-gradient(135deg, #043983, #4575b3, #679fdb);
        }

        .button{
            position: absolute;
            left: 9px;
            top: 9px;
            padding: 10px 60px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(135deg, #01265A, #345785, #5381B2);
            color: #fff;
            cursor: pointer;
            font-size: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)
        }
        .imagebg{
            position: fixed;
            width: 100%;
            height: 100vh;
            opacity: 25%;
            z-index: -10 ;
        }
        .button:hover{
            background: linear-gradient(135deg, #043983, #4575b3, #679fdb);
        }

        button:hover {
            background-color: #163d56;
        }
    </style>
</head>
<body>
    <img class="imagebg" src="{{ asset('image/image_bg.jpg') }}" alt="">
    <a href="/login" style="position: absolute; left: 9px; top:9px;"><button class="learn-more haloss">
        <span class="circle" aria-hidden="true">
        <span class="icon arrow"></span>
        </span>
        <span class="button-text">Login</span>
      </button></a>
    <div class="container" >
        <p>"Silakan masukkan NISN Anda atau gunakan scanner sidik jari <br>untuk verifikasi."</p>
        <div style="display: flex; justify-content: center; align-items: center; text-align: center; width: 100%;">
        <form id="nisnForm" action="user/cari" method="POST">
            @csrf
            <input type="text" id="nisnInput" name="nisn" placeholder="Masukkan NISN" maxlength="6" oninput="validateNISN(this)">
        </form>
        
        <button style="height: 60px;">Cari</button><br>
    </div>
        <img src="{{ asset('image/tangan.gif') }}" alt="Deskripsi alternatif">
    </div>
    <br>

    <script>
        function validateNISN(input) {
            // Hanya memperbolehkan angka
            input.value = input.value.replace(/\D/g, '');
            
            // Jika panjang input mencapai 6 karakter, kirimkan form
            if (input.value.length === 6) {
                document.getElementById('nisnForm').submit();
            }
        }
    </script>

<script>
    @if(Session::has('tidak_ditemukan'))
  
    Swal.fire({
      title: 'Gagal',
      text: 'Data Anda tidak ditemukan',
      icon: 'error',
      confirmButtonText: 'Oke'
    })
    @elseif(Session::has('sudah_absen'))
  
    Swal.fire({
      title: 'Gagal',
      text: 'Anda Sudah absen masuk dan absen keluar hari ini',
      icon: 'error',
      confirmButtonText: 'Oke'
    })
    @elseif(Session::has('berhasil_keluar'))
  
    Swal.fire({
      title: 'Berhasil',
      text: 'Anda sudah berhasil absensi keluar',
      icon: 'success',
      confirmButtonText: 'Oke'
    })
    @elseif(Session::has('membaca_buku'))
  
    Swal.fire({
      title: 'Berhasil',
      text: 'Anda berhasil absen untuk membaca buku hari ini dan Jangan lupa absen untuk keluar',
      icon: 'success',
      confirmButtonText: 'Oke'
    })
    @elseif(Session::has('pinjam_buku'))
  
    Swal.fire({
      title: 'Berhasil',
      text: 'Silahkan Pilih Buku yang akan anda pinjam pada rak lalu menuju ke meja petugas perpustakaan untuk melakukan peminjaman dan Jangan lupa absen untuk keluar',
      icon: 'success',
      confirmButtonText: 'Oke'
    })
    @elseif(Session::has('kembalikan_buku'))
  
    Swal.fire({
      title: 'Berhasil',
      text: 'Silahkan menuju ke meja petugas untuk melakukan pengembalian dan tekan tombol antrian dan Jangan lupa absen untuk keluar',
      icon: 'success',
      confirmButtonText: 'Oke'
    })
    @endif
    </script>
</body>
</html>
