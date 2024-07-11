@extends('admin.template.template-header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card px-4 py-2 ">
        <a><button type="submit" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahguru">Tambah Mata Pelajaran</button></a>
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
                    @foreach ($matkul as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->subject_name }}</td>
                            <td class="button_intable d-flex gap-2">
                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editsiswa{{ $item->id }}">Edit</button>
                                <form action="/admin/matkul/hapus/{{ $item->id }}" method="POST">
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
                                  <h5 class="modal-title" id="modalToggleLabel">Edit Mata Pelajaran</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/admin/matkul/edit/{{ $item->id }}" method="POST">
                                  @csrf
                                    @method('put')
                                <div class="modal-body">
                                  <div class="dua_label d-flex gap-3">
                                    <label for="defaultFormControlInput" class="form-label">Nama Mata Pelajaran</label>
                                </div>
                                <div class="dua_input d-flex gap-3 mb-2">
                                  <input type="text" value="{{ $item->subject_name }}" class="form-control w-100"
                                       placeholder="Masukkan Nama Mata Pelajaran" name="mata_pelajaran"
                                      aria-describedby="defaultFormControlHelp" />
                        
                              </div>
                              
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Edit Mata Pelajaran Baru</button>
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
          <h5 class="modal-title" id="modalToggleLabel">Tambah Mata Pelajaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/matkul/tambah" method="POST">
          @csrf
        
        <div class="modal-body">
          <div class="dua_label d-flex gap-3">
            <label for="defaultFormControlInput" class="form-label">Nama Mata Pelajaran</label>
        </div>
        <div class="dua_input d-flex gap-3 mb-2">
          <input type="text" value="" class="form-control w-100"
               placeholder="Masukkan Nama Mata Pelajaran" name="mata_pelajaran"
              aria-describedby="defaultFormControlHelp" />

      </div>
      
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Tambah Mata Pelajaran Baru</button>
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