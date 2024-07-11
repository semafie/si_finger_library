<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Ibnu Sibna - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="warna_kanan"></div>
    <div class="warna_kiri"></div>
    <a href="/" style="position: absolute; left: 9px; top:9px;"><button class="learn-more haloss">
        <span class="circle" aria-hidden="true">
        <span class="icon arrow"></span>
        </span>
        <span class="button-text">Go Back</span>
      </button></a>
    <div class="container">
        <div class="left-side">
            <img src="image/image_login.png" alt="Library Illustration">
        </div>
        <div class="right-side">
            <div class="login-box">
                <h2>PERPUSTAKAAN</h2>
                <img class="" src="image/logo_man.png" alt="">
                <h2>IBNU SIBNA</h2>
                <h3>WELCOME BACK</h3>
                <form action="/loginakun" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="your email" value="" required>
                    <input type="password" name="password" placeholder="your password" value="" required>
                    <button type="submit">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        @if(Session::has('login_dulu'))
      
        Swal.fire({
          title: 'Gagal',
          text: 'Anda Wajib login Terlebih dahulu',
          icon: 'error',
          confirmButtonText: 'Oke'
        })
        @elseif(Session::has('gagal_login'))
      
        Swal.fire({
          title: 'Gagal',
          text: 'Masukkan email dan password dengan benar',
          icon: 'error',
          confirmButtonText: 'Oke'
        })
        @endif
        </script>
</body>
</html>