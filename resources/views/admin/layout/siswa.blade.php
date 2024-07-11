@extends('admin.template.template-header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card px-4 py-2 ">
        <a><button type="submit" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahguru">Tambah Data Siswa</button></a>
              <div class="text-nowrap table-responsive pt-0">
                <table id="myTable" class="datatables-basic table border-top">
                  <thead>
                    <tr>
                      <th>nisn</th>
                      <th>nama Siswa</th>
                      <th>Kelas</th>
                      <th>Jenis Kelamin</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($siswa as $item)
                        <tr>
                            <td>{{ $item->nisn }}</td>
                            <td>{{ $item->student_name }}</td>
                            <td>{{ $item->class }}</td>
                            <td>{{ $item->gender }}</td>
                            <td class="button_intable d-flex gap-2">
                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editsiswa{{ $item->id }}">Edit</button>
                                <form action="/admin/siswa/hapus/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editsiswa{{ $item->id }}" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalToggleLabel">Edit Siswa</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/admin/siswa/edit/{{ $item->id }}" method="POST">
                                  @csrf
                                    @method('put')
                                <div class="modal-body">
                                  <div class="dua_label d-flex gap-3">
                                    <label for="defaultFormControlInput" class="form-label w-50">NISN</label>
                                    <label for="defaultFormControlInput" class="form-label w-50">Nama Siswa</label>
                                </div>
                                <div class="dua_input d-flex gap-3 mb-2">
                                  <input type="text"class="form-control w-50" value="{{ $item->nisn }}"
                                       placeholder="Masukkan NISN" name="nisn"
                                      aria-describedby="defaultFormControlHelp" />
                                  <input type="text"name="nama_siswa" class="form-control w-50" id="defaultFormControlInput"
                                      placeholder="Masukkan nama Siswa" value="{{ $item->student_name }}"
                                      aria-describedby="defaultFormControlHelp" />
                              </div>
                              <div class="dua_label d-flex justify-content-center">
                                <label for="defaultFormControlInput" class="form-label w-50">Kelas</label>
                                <label for="defaultFormControlInput" class="form-label w-50">Jenis Kelamin</label>
                            </div>
                            <div class="dua_input d-flex justify-content-center gap-3">
                                <input type="text"name="kelas" class="form-control w-50" id="defaultFormControlInput"
                                      placeholder="Masukkan nama Kelas" value="{{ $item->class }}"
                                      aria-describedby="defaultFormControlHelp" />
                              <select id="defaultSelect" name="jenis_kelamin" class="form-select w-50">
                                <option value="Laki - Laki" {{ $item->gender == 'Laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                                <option value="Perempuan" {{ $item->gender == 'Laki-laki' ? 'selected' : '' }}>Perempuan</option>
                              </select>
                          </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Edit Data Siswa</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
                    @endforeach
                  </tbody>
                </table>
              </div>

    </div>
</div>

<div class="modal fade" id="tambahguru" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Tambah Guru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/siswa/tambah" method="POST">
          @csrf
        
        <div class="modal-body">
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label w-50">NISN</label>
            <label for="defaultFormControlInput" class="form-label w-50">Nama Siswa</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
          <input type="text"class="form-control w-50"
               placeholder="Masukkan NISN" name="nisn"
              aria-describedby="defaultFormControlHelp" />
          <input type="text"name="nama_siswa" class="form-control w-50" id="defaultFormControlInput"
              placeholder="Masukkan nama Siswa"
              aria-describedby="defaultFormControlHelp" />
      </div>
      <div class="dua_label d-flex justify-content-center">
        <label for="defaultFormControlInput" class="form-label w-50">Kelas</label>
        <label for="defaultFormControlInput" class="form-label w-50">Jenis Kelamin</label>
    </div>
    <div class="dua_input d-flex justify-content-center gap-3">
        <input type="text"name="kelas" class="form-control w-50" id="defaultFormControlInput"
              placeholder="Masukkan nama Kelas"
              aria-describedby="defaultFormControlHelp" />
      <select id="defaultSelect" name="jenis_kelamin" class="form-select w-50">
        <option value="Laki - Laki">Laki - Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
  </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Tambah Siswa Baru</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <script>
    let table = new DataTable('#myTable');
</script>
<script>
  @if(Session::has('kosong_tambah'))

  Swal.fire({
    title: 'Berhasil',
    text: 'Data tidak boleh kosong',
    icon: 'error',
    confirmButtonText: 'Oke'
  })
  @elseif(Session::has('berhasil_tambah'))

  Swal.fire({
    title: 'Berhasil',
    text: 'Data Berhasil ditambahkan',
    icon: 'success',
    confirmButtonText: 'Oke'
  })
  @elseif(Session::has('berhasil_edit'))

  Swal.fire({
    title: 'Berhasil',
    text: 'Data Berhasil diedit',
    icon: 'success',
    confirmButtonText: 'Oke'
  })
  @elseif(Session::has('berhasil_hapus'))

  Swal.fire({
    title: 'Berhasil',
    text: 'Data Berhasil dihapus',
    icon: 'success',
    confirmButtonText: 'Oke'
  })
  @endif
  </script>
@endsection