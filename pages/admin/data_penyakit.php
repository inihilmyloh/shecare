<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md-12">
      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalStore"><i class="bi bi-plus-circle-fill"></i> Tambah Data Penyakit</button>
    </div>
    <div class="col-md 12">
      <table id="data_penyakit" class="cell-border compact stripe hover nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Penyakit</th>
            <th>Deskripsi Penyakit</th>
            <th>Nama Admin yang Menambahkan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tbody"></tbody>
      </table>
    </div>
  </div>
  <?php include "pages/layout/admin/footer.php";?>
</div>

<!-- Modal Show -->
<div class="modal modal-xl fade" id="modalShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table">
          <tr>
            <th>Nama Penyakit</th>
            <td id="show_nama_penyakit"></td>
          </tr>
          <tr>
            <th>Deskripsi Penyakit</th>
            <td id="show_deskripsi_penyakit"></td>
          </tr>
          <tr>
            <th>Nama Admin yang Menambahkan</th>
            <td id="show_name"></td>
          </tr>
          <tr>
            <th>Dibuat pada</th>
            <td id="show_created_at"></td>
          </tr>
          <tr>
            <th>Diperbarui pada</th>
            <td id="show_updated_at"></td>
          </tr>
          <tr>
            <th>Thumbnail</th>
            <td id="show_thumbnail"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Store -->
<div class="modal modal-xl fade" id="modalStore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Nama Penyakit</th>
            <td>
              <input type="text" id="store_nama_penyakit" class="form-control" />
            </td>
          </tr>
          <tr>
            <th>Deskripsi Penyakit</th>
            <td>
              <textarea id="store_deskripsi_penyakit" class="form-control"></textarea>
            </td>
          </tr>
          <tr>
            <th>Thumbnail</th>
            <td>
              <input type="file" id="store_thumbnail" class="form-control" />
            </td>
          </tr>
          <tr>
            <th>Nama Admin yang Menambahkan</th>
            <td>
              <!-- Nama admin tidak bisa diubah -->
               <input type="text" id="store_nama_user" disabled class="form-control" value="<?= $_SESSION['name'] ?>"/>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" data-id="null" id="btn-update" class="btn btn-success" onclick="addData()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal modal-xl fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Nama Penyakit</th>
            <td>
              <input type="text" id="edit_nama_penyakit" class="form-control" />
            </td>
          </tr>
          <tr>
            <th>Deskripsi Penyakit</th>
            <td>
              <textarea id="edit_deskripsi_penyakit" class="form-control"></textarea>
            </td>
          </tr>
          <tr>
            <th>Nama Admin yang Menambahkan</th>
            <td>
              <!-- Nama admin tidak bisa diubah -->
               <input type="text" id="edit_nama_user" disabled class="form-control" value=""/>
            </td>
          </tr>
          <tr>
            <th>Thumbnail (default tidak berubah)</th>
            <td><input type="file" id="edit_thumbnail" class="form-control" /></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" data-id="null" id="btn-update" class="btn btn-success" onclick="updateData()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDestroy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Apakah anda yakin ingin menghapus data ini? Berikut detail dari data yang akan dihapus</h4>
        <table class="table">
          <tr>
            <th>Nama Penyakit</th>
            <td id="delete_nama_penyakit"></td>
          </tr>
          <tr>
            <th>Deskripsi Penyakit</th>
            <td id="delete_deskripsi_penyakit"></td>
          </tr>
          <tr>
            <th>Nama Admin yang Menambahkan</th>
            <td id="delete_name"></td>
          </tr>
          <tr>
            <th>Dibuat pada</th>
            <td id="delete_created_at"></td>
          </tr>
          <tr>
            <th>Diperbarui pada</th>
            <td id="delete_updated_at"></td>
          </tr>
          <tr>
            <th>Thumbnail</th>
            <td><img id="delete_thumbnail" src="" alt="Thumbnail" style="max-width: 100px;" /></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btn-delete" data-id="null" onclick="deleteData()" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function () {
    $('#data_penyakit').DataTable({
      processing: true,
      ajax: {
        url: 'crud/index_data_penyakit.php',
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + 1;
          }
        },
        { data: 'nama_penyakit' },
        { data: 'deskripsi_penyakit' },
        { data: 'nama_user' },
        { 
          data: null,
          render: function (data, type, row, meta) {
            return `
              <button type="button" data-id="${row.id_penyakit}" onclick="getDataShow(this)" data-bs-toggle="modal" data-bs-target="#modalShow" class="btn btn-secondary p-2"><i class="bi bi-eye-fill"></i></button>
              <button type="button" data-id="${row.id_penyakit}" onclick="getDataEdit(this)" data-bs-toggle="modal" data-bs-target="#modalEdit" class="btn btn-warning p-2"><i class="bi bi-pencil-fill"></i></button>
              <button type="button" data-id="${row.id_penyakit}" onclick="getDataDelete(this)" data-bs-toggle="modal" data-bs-target="#modalDestroy" class="btn btn-danger p-2"><i class="bi bi-trash-fill"></i></button>
            `;
          }
        }
      ]
    });
  });

  function addData() {
    const nama_penyakit = $('#store_nama_penyakit').val();
    const deskripsi_penyakit = $('#store_deskripsi_penyakit').val();
    const thumbnail = $('#store_thumbnail')[0].files[0];

    if(!nama_penyakit || !deskripsi_penyakit || !thumbnail) {
      Swal.fire({
        title: 'Kesalahan',
        text: 'Semua field harus diisi',
        icon: 'error',
      });
      return;
    }

    Swal.fire({
      title: 'Memproses',
      text: 'Mohon tunggu...',
      icon: 'info',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    let formData = new FormData();
    formData.append('nama_penyakit', nama_penyakit);
    formData.append('deskripsi_penyakit', deskripsi_penyakit);
    formData.append('thumbnail', thumbnail);

    $.ajax({
      url: "crud/store_data_penyakit.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        let data = JSON.parse(response);
        if(data.status) {
          Swal.fire({
            title: 'Berhasil',
            text: data.message,
            icon: 'success',
          });
          $('#modalStore').modal('hide');
          $('#data_penyakit').DataTable().ajax.reload();
        } else {
          Swal.fire({
            title: 'Gagal',
            text: 'Terjadi kesalahan saat menambahkan data',
            icon: 'error',
          });
        }
      }
    });
  }

  function getDataShow(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_penyakit.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#show_nama_penyakit').text(data.data.nama_penyakit);
        $('#show_deskripsi_penyakit').text(data.data.deskripsi_penyakit);
        $('#show_thumbnail').html(`<img src="data:image/jpeg;base64,${data.data.thumbnail}" alt="Thumbnail" style="max-width: 50%;">`);
        $('#show_name').text(data.data.nama_user);
        $('#show_created_at').text(data.data.created_at);
        $('#show_updated_at').text(data.data.updated_at);
      }
    });
  }

  function getDataEdit(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_penyakit.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#edit_nama_penyakit').val(data.data.nama_penyakit);
        $('#edit_deskripsi_penyakit').val(data.data.deskripsi_penyakit);
        $('#edit_nama_user').val(data.data.nama_user);
        $('#btn-update').attr('data-id', data.data.id_penyakit);
      }
    });
  }

  function updateData() {
    const id = $('#btn-update').attr('data-id');
    const nama_penyakit = $('#edit_nama_penyakit').val();
    const deskripsi_penyakit = $('#edit_deskripsi_penyakit').val();
    const thumbnail = $('#edit_thumbnail')[0].files[0];

    if(!nama_penyakit || !deskripsi_penyakit || !thumbnail) {
      Swal.fire({
        title: 'Kesalahan',
        text: 'Semua field harus diisi',
        icon: 'error',
      });
      return;
    }

    Swal.fire({
      title: 'Memproses',
      text: 'Mohon tunggu...',
      icon: 'info',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    let formData = new FormData();
    formData.append('id', id);
    formData.append('nama_penyakit', nama_penyakit);
    formData.append('deskripsi_penyakit', deskripsi_penyakit);
    formData.append('thumbnail', thumbnail);
    $.ajax({
      url: "crud/update_data_penyakit.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        let data = JSON.parse(response);
        if(data.status) {
          Swal.fire({
            title: 'Berhasil',
            text: data.message,
            icon: 'success',
          });
          $('#modalEdit').modal('hide');
          $('#data_penyakit').DataTable().ajax.reload();
        } else {
          Swal.fire({
            title: 'Gagal',
            text: 'Terjadi kesalahan saat memperbarui data',
            icon: 'error',
          });
        }
      }
    });
  }

  function getDataDelete(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_penyakit.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#delete_nama_penyakit').text(data.data.nama_penyakit);
        $('#delete_deskripsi_penyakit').text(data.data.deskripsi_penyakit);
        $('#delete_thumbnail').attr('src', `data:image/jpeg;base64,${data.data.thumbnail}`);
        $('#delete_name').text(data.data.nama_user);
        $('#delete_created_at').text(data.data.created_at);
        $('#delete_updated_at').text(data.data.updated_at);
        $('#btn-delete').attr('data-id', data.data.id_penyakit);
      }
    });
  }

  function deleteData() {
    const id = $('#btn-delete').attr('data-id');

    $.post("crud/destroy_data_penyakit.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Data penyakit berhasil dihapus',
          icon: 'success',
        });
        $('#modalDestroy').modal('hide');
        $('#data_penyakit').DataTable().ajax.reload();
      } else {
        Swal.fire({
          title: 'Gagal',
          text: 'Terjadi kesalahan saat menghapus data',
          icon: 'error',
        });
      }
    });
  }
</script>