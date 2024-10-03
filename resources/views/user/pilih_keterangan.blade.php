<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      
      {{-- DATATABLE --}}
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
      <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('css/user.css')}}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-height: 100vh;
            margin: 0;
            height: 100vh;
            background-color: #0a2d5d;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .imagebg{
            position: absolute;
            width: 100%;
            height: 100vh;
            opacity: 25%;
            z-index: -1 ;
        }

        p{
            font-size: 35px;
            text-align: center;
        }

        .container{
            display: flex;
            flex-direction: column;
            text-align: center;
            gap: 35px;
        }
    </style>
</head>
<body>
    <div style="position: absolute; right: 9px; top:9px;">
        <img style="height: 70px" src="{{ asset('image/logoperpus.png') }}" alt="">
        <img style="height: 70px" src="{{ asset('image/logoman.png') }}" alt="">
      </div>
    <img class="imagebg" src="{{ asset('image/image_bg.jpg') }}" alt="">
        <p>Selamat datang 
            @if( $siswa->gender == 'Laki - Laki' )
            siswa
            @elseif($siswa->gender == 'Perempuan')
                siswi
            @endif 
            {{ $siswa->student_name }} 
            di perpustakaan Ibnu Sina. Silahkan pilih aktifitas yang<br>
            akan anda lakukan</p>

    
    <div class="container">
        
        <form action="/user/baca/{{ $siswa->id }}" method="POST">
            @csrf
            @method('put')
            <button class="btn">Pengunjung (Membaca Buku)</button></form>
        <form action="/user/pinjam/{{ $siswa->id }}" method="POST">
            @csrf
            @method('put')
            <button class="btn">Pengunjung (Peminjaman Buku)</button></form>
            <form action="/user/kembali/{{ $siswa->id }}" method="POST">
                @csrf
            @method('put')
                <button class="btn">Pengunjung (Pengembalian Buku)</button></form>
                <form action="/user/setbelajar" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $siswa->nisn }}" name="nisn">
                    <input type="hidden" value="{{ $siswa->id }}" name="id">
                    <button class="btn">Pengunjung (Pembelajaran)</button>
                </form>
    </div>



    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>