@extends('admin.template.template-header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card px-4 py-2 ">
      <a><button type="submit" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahguru">Tambah Data Guru</button></a>
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

                        <div class="modal fade" id="editguru{{ $item->id }}" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalToggleLabel">Edit Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="/admin/guru/edit/{{ $item->id }}" method="POST">
                                @method('put')
                                @csrf
                              
                              <div class="modal-body">
                                <div class="dua_label d-flex gap-3">
                                  <label for="defaultFormControlInput" class="form-label w-50">NIP</label>
                                  <label for="defaultFormControlInput" class="form-label w-50">Nama Guru</label>
                              </div>
                              <div class="dua_input d-flex gap-3 mb-2">
                                <input type="text" class="form-control w-50" placeholder="Masukkan NIP" name="nip" value="{{ $item->nip }}" aria-describedby="defaultFormControlHelp" />
                                <input type="text" name="nama_guru" value="{{ $item->teacher_name }}" class="form-control w-50" id="defaultFormControlInput"
                                    placeholder="Masukkan nama Guru"
                                    aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div class="dua_label d-flex justify-content-center">
                              <label for="defaultFormControlInput" class="form-label w-50">Jenis Kelamin</label>
                          </div>
                          <div class="dua_input d-flex justify-content-center">
                            <select id="defaultSelect" name="jenis_kelamin" class="form-select w-50">
                              <option value="Laki - Laki" {{ $item->gender == 'Laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                              <option value="Perempuan" {{ $item->gender == 'Laki-laki' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Edit Guru</button>
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
      <form action="/admin/guru/tambah" method="POST">
        @csrf
      
      <div class="modal-body">
        <div class="dua_label d-flex gap-3">
          <label for="defaultFormControlInput" class="form-label w-50">NIP</label>
          <label for="defaultFormControlInput" class="form-label w-50">Nama Guru</label>
      </div>
      <div class="dua_input d-flex gap-3 mb-2">
        <input type="text" value="" class="form-control w-50"
             placeholder="Masukkan NIP" name="nip"
            aria-describedby="defaultFormControlHelp" />
        <input type="text" value="" name="nama_guru" class="form-control w-50" id="defaultFormControlInput"
            placeholder="Masukkan nama Guru"
            aria-describedby="defaultFormControlHelp" />
    </div>
    <div class="dua_label d-flex justify-content-center">
      <label for="defaultFormControlInput" class="form-label w-50">Jenis Kelamin</label>
  </div>
  <div class="dua_input d-flex justify-content-center">
    <select id="defaultSelect" name="jenis_kelamin" class="form-select w-50">
      <option value="Laki - Laki">Laki - Laki</option>
      <option value="Perempuan">Perempuan</option>
    </select>
</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Tambah Guru</button>
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