<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md-12">
      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalStore"><i class="bi bi-plus-circle-fill"></i> Tambah Data Artikel</button>
    </div>
    <div class="col-md 12">
      <table id="data_artikel" class="cell-border compact stripe hover nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul Artikel</th>
            <th>Deskripsi</th>
            <th>Domain Asal</th>
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
            <th>Judul Artikel</th>
            <td id="show_judul_artikel"></td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td id="show_deskripsi"></td>
          </tr>
          <tr>
            <th>Domain Asal</th>
            <td id="show_domain_asal"></td>
          </tr>
          <tr>
            <th>URL</th>
            <td id="show_url"></td>
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
            <th>Judul Artikel</th>
            <td><input type="text" id="store_judul_artikel" class="form-control" /></td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td><textarea id="store_deskripsi" class="form-control"></textarea></td>
          </tr>
          <tr>
            <th>Domain Asal</th>
            <td><input type="text" id="store_domain_asal" class="form-control" /></td>
          </tr>
          <tr>
            <th>URL</th>
            <td><input type="text" id="store_url" class="form-control" /></td>
          </tr>
          <tr>
            <th>Thumbnail</th>
            <td><input type="file" id="store_thumbnail" class="form-control" /></td>
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
            <th>Judul Artikel</th>
            <td><input type="text" id="edit_judul_artikel" class="form-control" /></td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td><textarea id="edit_deskripsi" class="form-control"></textarea></td>
          </tr>
          <tr>
            <th>Domain Asal</th>
            <td><input type="text" id="edit_domain_asal" class="form-control" /></td>
          </tr>
          <tr>
            <th>URL</th>
            <td><input type="text" id="edit_url" class="form-control" /></td>
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
            <th>Judul Artikel</th>
            <td id="delete_judul_artikel"></td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td id="delete_deskripsi"></td>
          </tr>
          <tr>
            <th>Domain Asal</th>
            <td id="delete_domain_asal"></td>
          </tr>
          <tr>
            <th>URL</th>
            <td id="delete_url"></td>
          </tr>
          <tr>
            <th>Thumbnail</th>
            <td id="delete_thumbnail"></td>
          </tr>
          <tr>
            <th>Dibuat pada</th>
            <td id="delete_created_at"></td>
          </tr>
          <tr>
            <th>Diperbarui pada</th>
            <td id="delete_updated_at"></td>
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
    $('#data_artikel').DataTable({
      processing: true,
      ajax: {
        url: 'crud/index_data_artikel.php',
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + 1;
          }
        },
        { data: 'judul_artikel' },
        { data: 'deskripsi' },
        { data: 'domain_asal' },
        { 
          data: null,
          render: function (data, type, row, meta) {
            return `
              <button type="button" data-id="${row.id_artikel}" onclick="getDataShow(this)" data-bs-toggle="modal" data-bs-target="#modalShow" class="btn btn-secondary p-2"><i class="bi bi-eye-fill"></i></button>
              <button type="button" data-id="${row.id_artikel}" onclick="getDataEdit(this)" data-bs-toggle="modal" data-bs-target="#modalEdit" class="btn btn-warning p-2"><i class="bi bi-pencil-fill"></i></button>
              <button type="button" data-id="${row.id_artikel}" onclick="getDataDelete(this)" data-bs-toggle="modal" data-bs-target="#modalDestroy" class="btn btn-danger p-2"><i class="bi bi-trash-fill"></i></button>
            `;
          }
        }
      ]
    });
  });

  function addData() {
    const judul_artikel = $('#store_judul_artikel').val();
    const deskripsi = $('#store_deskripsi').val();
    const domain_asal = $('#store_domain_asal').val();
    const url = $('#store_url').val();
    const thumbnail = $('#store_thumbnail')[0].files[0];

    if(!judul_artikel || !deskripsi || !domain_asal || !url || !thumbnail) {
      Swal.fire({
        title: 'Kesalahan',
        text: 'Semua field harus diisi',
        icon: 'error',
      });
      return;
    }

    const formData = new FormData();
    formData.append('judul_artikel', judul_artikel);
    formData.append('deskripsi', deskripsi);
    formData.append('domain_asal', domain_asal);
    formData.append('url', url);
    formData.append('thumbnail', thumbnail);

    $.ajax({
      url: "crud/store_data_artikel.php",
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
          $('#data_artikel').DataTable().ajax.reload();
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
    $.get("crud/show_data_artikel.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#show_judul_artikel').text(data.data.judul_artikel);
        $('#show_deskripsi').text(data.data.deskripsi);
        $('#show_domain_asal').text(data.data.domain_asal);
        $('#show_url').text(data.data.url);
        $('#show_thumbnail').html(`<img src="data:image/jpeg;base64,${data.data.thumbnail}" alt="Thumbnail" style="max-width: 50%;">`);
        $('#show_created_at').text(data.data.created_at);
        $('#show_updated_at').text(data.data.updated_at);
      }
    });
  }

  function getDataEdit(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_artikel.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#edit_judul_artikel').val(data.data.judul_artikel);
        $('#edit_deskripsi').val(data.data.deskripsi);
        $('#edit_domain_asal').val(data.data.domain_asal);
        $('#edit_url').val(data.data.url);
        // Note: For thumbnail, you might want to handle file input differently -> Okay to leave it empty for now
        $('#btn-update').attr('data-id', data.data.id_artikel);
      }
    });
  }

  function updateData() {
    const id = $('#btn-update').attr('data-id');
    const judul_artikel = $('#edit_judul_artikel').val();
    const deskripsi = $('#edit_deskripsi').val();
    const domain_asal = $('#edit_domain_asal').val();
    const url = $('#edit_url').val();
    const thumbnail = $('#edit_thumbnail')[0].files[0];

    const formData = new FormData();
    formData.append('id', id);
    formData.append('judul_artikel', judul_artikel);
    formData.append('deskripsi', deskripsi);
    formData.append('domain_asal', domain_asal);
    formData.append('url', url);
    if (thumbnail) {
      formData.append('thumbnail', thumbnail);
    }

    $.ajax({
      url: "crud/update_data_artikel.php",
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
          $('#data_artikel').DataTable().ajax.reload();
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
    $.get("crud/show_data_artikel.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#delete_judul_artikel').text(data.data.judul_artikel);
        $('#delete_deskripsi').text(data.data.deskripsi);
        $('#delete_domain_asal').text(data.data.domain_asal);
        $('#delete_url').text(data.data.url);
        $('#delete_thumbnail').html(`<img src="data:image/jpeg;base64,${data.data.thumbnail}" alt="Thumbnail" style="max-width: 100%;">`);
        $('#delete_created_at').text(data.data.created_at);
        $('#delete_updated_at').text(data.data.updated_at);
        $('#btn-delete').attr('data-id', data.data.id_artikel);
      }
    });
  }

  function deleteData() {
    const id = $('#btn-delete').attr('data-id');

    $.post("crud/destroy_data_artikel.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Data user berhasil dihapus',
          icon: 'success',
        });
        $('#modalDestroy').modal('hide');
        $('#data_artikel').DataTable().ajax.reload();
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