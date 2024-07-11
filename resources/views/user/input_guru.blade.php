<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
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
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-height: 100vh;
            margin: 0;
            gap: 30px;
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
            justify-content: center;
            gap: 35px;
        }
    </style>
</head>
<body>
    <img class="imagebg" src="{{ asset('image/image_bg.jpg') }}" alt="">
        <p>Silahkan inputkan guru yang mengajar dan mata pelajaranya<br>
</p>
{{-- <div class="container"> --}}
    <form action="/user/pembelajaran" method="POST" class="" >
        @csrf

    <div class="d-flex w-100 " style=" align-items: center; gap: 20px; margin-bottom: 25px;">
        <input type="text" class="form-control w-70" id="namaguru" readonly placeholder="Masukkan guru" aria-describedby="defaultFormControlHelp" />
    <input required="" type="hidden" id="idguru" name="id_guru"/>
    <input required="" type="hidden" id="idmapel" name="id_mapel" />
    <input required="" type="hidden" value="{{ $siswa->id }}" name="id_siswa"/>
            <button type="button" class="btn btn-primary" style="width: 30%; height: 70%; " data-bs-toggle="modal" data-bs-target="#cariguru">Cari Guru</button>
    </div>
    <div class="d-flex w-100" style="width: 600px; align-items: center; gap: 20px; margin-bottom: 25px;">
        <input type="text" class="form-control w-70" id="namamapel" readonly placeholder="Masukkan mapel" aria-describedby="defaultFormControlHelp" />
    <button type="button" class="btn btn-primary" style="width: 30%; height: 70%" data-bs-toggle="modal" data-bs-target="#carimapel">Cari Mapel</button>
</div>
    <div class="d-flex" style="width: 600px; align-items: center; margin-bottom: 25px;">
        <input type="text" class="form-control w-100" name="keterangan" placeholder="Masukkan keterangan pelajaran" aria-describedby="defaultFormControlHelp" />

</div>
<div class="" style="width: 100%; display: flex; justify-content: center;">
    <button type="submit" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#tambahguru">Simpan / Next</button>
</div>

</form>
<form action="/user/kembalimemilih" method="post">
    @csrf
    <input type="hidden" value="{{ $siswa->nisn }}" name="nisn">
    <button type="submit" class="btn btn-warning" style="width: 150px;"  data-bs-toggle="modal" data-bs-target="#tambahguru">Kembali</button>
</form>



<div class="modal fade" id="cariguru" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Cari Guru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="text-nowrap table-responsive pt-0">
                <table id="myTable" class="datatables-basic table border-top">
                  <thead>
                    <tr>
                      <th>nip</th>
                      <th>nama Guru</th>
                      <th>Jenis Kelamin</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($guru as $item)
                        <tr>
                          <td>{{ $item->nip }}</td>
                          <td>{{ $item->teacher_name }}</td>
                          <td>{{ $item->gender }}</td>
                          <td>
                            <button class="btn btn-warning" onclick="pilihguru('{{ $item->id }}','{{ $item->teacher_name }}')" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Pilih Guru</button>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        

        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="carimapel" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Cari Guru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="text-nowrap table-responsive pt-0">
                <table id="myTable" class="datatables-basic table border-top">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>nama mata pelajaran</th>
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mapel as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->subject_name }}</td>
                            <td>
                                <button class="btn btn-warning" onclick="pilihmapel('{{ $item->id }}','{{ $item->subject_name }}')" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Pilih Mapel</button>
                            </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
            </div>
        

        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
{{-- </div> --}}
<script>
    function pilihguru(id,namaguru) {
    document.getElementById("namaguru").value = namaguru;
    document.getElementById("idguru").value = id;
    
  }
  
  
  </script>
<script>
    function pilihmapel(id,namamapel) {
    document.getElementById("namamapel").value = namamapel;
    document.getElementById("idmapel").value = id;
    
  }
  
  
  </script>

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