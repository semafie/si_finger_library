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
          <input type="text" value="" class="form-control " style="width: 30%;"
               placeholder="Masukkan id siswa" name="id_siswa"
              aria-describedby="defaultFormControlHelp" />
              <button type="submit" class="btn btn-primary" style="width: 20%;" data-bs-toggle="modal" data-bs-target="#tambahguru">Cari Siswa</button>
          <input type="text" value="" class="form-control w-50"
               placeholder="Masukkan NISN" readonly name="nisn"
              aria-describedby="defaultFormControlHelp" />

      </div>
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label " style="width: calc(50% + 16px);">jam masuk</label>
            <label for="defaultFormControlInput" class="form-label w-50">jam keluar</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
            <input class="form-control" type="time" value="12:30:00" style="width: calc(50% + 16px);" id="html5-time-input" />
            <input class="form-control w-50" type="time" value="12:30:00" id="html5-time-input" />

      </div>
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label " style="width: calc(50% + 16px);">tanggal</label>
            <label for="defaultFormControlInput" class="form-label w-50">keterangan</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
          <input type="text" value="" class="form-control " style="width: calc(50% + 16px);"
               placeholder="Masukkan tanggal" name="id_siswa"
              aria-describedby="defaultFormControlHelp" />
              <select id="selectketerangan" name="jenis_kelamin" class="form-select w-50">
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
            placeholder="Masukkan guru"
           aria-describedby="defaultFormControlHelp" />
           <button type="submit" class="btn btn-primary" style="width: 20%;" data-bs-toggle="modal" data-bs-target="#tambahguru">Cari Guru</button>
           <input type="text" value="" class="form-control " style="width: 30%;"
               placeholder="Masukkan mapel"
              aria-describedby="defaultFormControlHelp" />
              <button type="submit" class="btn btn-primary" style="width: 20%;" data-bs-toggle="modal" data-bs-target="#tambahguru">Cari Mapel</button>
          

      </div>
      <div class=" dua_label d-flex gap-3 halo" id="pembelajaran3">
        <label for="defaultFormControlInput" class="form-label " >Kelas Yang Di ajar</label>
    </div>
    <div class= "dua_input d-flex gap-3 mb-2 halo"  id="pembelajaran4">
      <input type="text" value="" class="form-control " 
           placeholder="Masukkan keterangan" name="id_siswa"
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