@extends('admin.template.template-header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card px-4 py-2 ">
        <a><button type="submit" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahguru">Tambah Data Absensi</button></a>
              <div class="text-nowrap table-responsive pt-0">
                <table id="myTable" class="datatables-basic table border-top">
                  <thead>
                    <tr>
                      <th>id_siswa</th>
                      <th>nisn</th>
                      <th>tanggal</th>
                      <th>jam masuk</th>
                      <th>jam keluar</th>
                      <th>keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($absensi as $item)
                    <tr>
                        <td>{{ $item->siswa->id }}</td>
                        <td>{{ $item->siswa->nisn }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_masuk }}</td>
                        <td>{{ $item->jam_keluar }}</td>
                        <td>{{ $item->keterangan }}</td>
                            <td class="button_intable d-flex gap-2">
                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editguru{{ $item->id }}">Edit</button>
                                <form action="/admin/guru/hapus/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

    </div>
</div>

{{-- <div class="modal fade" id="tambahguru" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Modal 1</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Show a second modal and hide this one with the button below.saaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
        </div>
      </div>
    </div>
  </div> --}}

<div class="modal fade" id="tambahguru" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 110%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Tambah Absensi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/absensi/tambah" method="POST">
          @csrf
        
        <div class="modal-body" >
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label " style="width: calc(50% + 16px);">id siswa</label>
            <label for="defaultFormControlInput" class="form-label w-50">Nisn</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
          <input type="text" value="" id="idsiswa" readonly class="form-control " style="width: 30%;"
               placeholder="Masukkan id siswa" name="id_siswa"
              aria-describedby="defaultFormControlHelp" />
              <button type="button" class="btn btn-primary" style="width: 20%;" data-bs-toggle="modal" data-bs-target="#carisiswa">Cari Siswa</button>
          <input type="text" value="" readonly id="nisnn" class="form-control w-50"
               placeholder="Masukkan NISN" readonly 
              aria-describedby="defaultFormControlHelp" />

      </div>
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label " style="width: calc(50% + 16px);">jam masuk</label>
            <label for="defaultFormControlInput" class="form-label w-50">jam keluar</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
            <input class="form-control" name="jam_masuk" type="time" value="12:30:00" style="width: calc(50% + 16px);" id="html5-time-input" />
            <input class="form-control w-50" name="jam_masuk" type="time" value="12:30:00" id="html5-time-input" />

      </div>
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label " style="width: calc(50% + 16px);">tanggal</label>
            <label for="defaultFormControlInput" class="form-label w-50">keterangan</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
          <input type="text" value="" readonly  class="form-control " style="width: calc(50% + 16px);"
               placeholder="Masukkan tanggal" name="tanggal" id="tanggalInput"
              aria-describedby="defaultFormControlHelp" />
              <select id="selectketerangan" name="keterangan" class="form-select w-50">
                <option value="Membaca Buku">Membaca Buku</option>
                <option value="Peminjaman Buku">Peminjaman Buku</option>
                <option value="Pengembalian Buku">Pengembalian Buku</option>
                <option value="Pembelajaran">Pembelajaran</option>
              </select>

      </div>

          <div  class=" dua_label d-flex gap-3 halo" id="pembelajaran1" >
            <label for="defaultFormControlInput" class="form-label " style="width: calc(50% + 16px);">Masukkan Guru</label>
            <label for="defaultFormControlInput" class="form-label w-50">Masukkan Mapel</label>
        </div>
        <div class= "d-flex gap-3 mb-2 halo" id="pembelajaran2" style="">
            <input type="text" value="" class="form-control " style="width: 30%;"
            placeholder="Masukkan guru" id="namaguru"
           aria-describedby="defaultFormControlHelp" />
            <input type="hidden" value="" class="form-control " style="width: 30%;"
            placeholder="Masukkan guru" name="id_guru" id="idguru"
           aria-describedby="defaultFormControlHelp" />
           <button type="button" class="btn btn-primary" style="width: 20%;" data-bs-toggle="modal" data-bs-target="#cariguru">Cari Guru</button>
           <input type="text" value="" class="form-control " style="width: 30%;"
               placeholder="Masukkan mapel" id="namamapel"
              aria-describedby="defaultFormControlHelp" />
           <input type="hidden" value="" class="form-control " style="width: 30%;"
               placeholder="Masukkan mapel" name="id_mapel" id="idmapel"
              aria-describedby="defaultFormControlHelp" />
              <button type="button" class="btn btn-primary" style="width: 20%;" data-bs-toggle="modal" data-bs-target="#carimapel">Cari Mapel</button>
          

      </div>
      <div class=" dua_label d-flex gap-3 halo" id="pembelajaran3">
        <label for="defaultFormControlInput" class="form-label " >Kelas Yang Di ajar</label>
    </div>
    <div class= "dua_input d-flex gap-3 mb-2 halo"  id="pembelajaran4">
      <input type="text" value="" class="form-control " 
           placeholder="Masukkan keterangan" name="kelas_diajar"
          aria-describedby="defaultFormControlHelp" />
    </div>
          


      
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Tambah Absensi Baru</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="carisiswa" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Cari Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="text-nowrap table-responsive pt-0">
                <table id="myTable" class="datatables-basic table border-top">
                  <thead>
                    <tr>
                      <th>nisn</th>
                      <th>nama Siswa</th>
                      <th>Jenis Kelamin</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($siswa as $item)
                        <tr>
                          <td>{{ $item->nisn }}</td>
                          <td>{{ $item->student_name }}</td>
                          <td>{{ $item->gender }}</td>
                          <td>
                            <button class="btn btn-warning" onclick="pilihsiswa('{{ $item->id }}','{{ $item->nisn }}')" data-bs-target="#tambahguru" data-bs-toggle="modal" data-bs-dismiss="modal">Pilih Siswa</button>
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
                            <button class="btn btn-warning" onclick="pilihguru('{{ $item->id }}','{{ $item->teacher_name }}')" data-bs-target="#tambahguru" data-bs-toggle="modal" data-bs-dismiss="modal">Pilih Guru</button>
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
                                <button class="btn btn-warning" onclick="pilihmapel('{{ $item->id }}','{{ $item->subject_name }}')" data-bs-target="#tambahguru" data-bs-toggle="modal" data-bs-dismiss="modal">Pilih Mapel</button>
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

  <script>
    $(document).ready(function() {
        var today = new Date().toISOString().slice(0, 10);
        $('#tanggalInput').val(today);
    });
</script>

  <script>
    function pilihsiswa(id,nisn) {
    document.getElementById("nisnn").value = nisn;
    document.getElementById("idsiswa").value = id;
    
  }
  
  
  </script>
  <script>
    function pilihguru(id,namaguru) {
    document.getElementById("idguru").value = id;
    document.getElementById("namaguru").value = namaguru;
    
  }
  
  
  </script>
  <script>
    function pilihmapel(id,namamapel) {
    document.getElementById("idmapel").value = id;
    document.getElementById("namamapel").value = namamapel;
    
  }
  
  
  </script>
  <script>
    function pilihsiswa(id,nisn) {
    document.getElementById("nisnn").value = nisn;
    document.getElementById("idsiswa").value = id;
    
  }
  
  
  </script>

  <script>
    let table = new DataTable('#myTable');
</script>

  <script>
    document.getElementById('selectketerangan').addEventListener('change', function () {
        var pembelajaran1 = document.getElementById('pembelajaran1');
        var pembelajaran2 = document.getElementById('pembelajaran2');
        var pembelajaran3 = document.getElementById('pembelajaran3');
        var pembelajaran4 = document.getElementById('pembelajaran4');
        
        if (this.value === 'Pembelajaran') {
            pembelajaran1.classList.add('show');
            pembelajaran1.classList.remove('halo');
            pembelajaran2.classList.add('show');
            pembelajaran2.classList.remove('halo');
            pembelajaran3.classList.add('show');
            pembelajaran3.classList.remove('halo');
            pembelajaran4.classList.add('show');
            pembelajaran4.classList.remove('halo');
        } else {
            pembelajaran1.classList.add('halo');
            pembelajaran1.classList.remove('show');
            pembelajaran2.classList.add('halo');
            pembelajaran2.classList.remove('show');
            pembelajaran3.classList.add('halo');
            pembelajaran3.classList.remove('show');
            pembelajaran4.classList.add('halo');
            pembelajaran4.classList.remove('show');
        }
    });
</script>
@endsection