<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-2">
          <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalStore"><i class="bi bi-plus-circle-fill"></i> Tambah Data Pertanyaan</button>
        </div>
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-7 text-center row align-content-center">
              Tampilkan data pertanyaan untuk penyakit:
            </div>
            <div class="col-md-5">
              <select id="daftar_penyakit" class="form-select">
                <option value="default">-- Pilih Penyakit --</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md 12">
      <table id="data_pertanyaan" class="cell-border compact stripe hover nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul Pertanyaan</th>
            <th>Nama Penyakit</th>
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
            <th>Judul Pertanyaan</th>
            <td id="show_judul_pertanyaan"></td>
          </tr>
          <tr>
            <th>Nama Penyakit</th>
            <td id="show_nama_penyakit"></td>
          </tr>
          <tr>
            <th>Dibuat pada</th>
            <td id="show_created_at"></td>
          </tr>
          <tr>
            <th>Diperbarui pada</th>
            <td id="show_updated_at"></td>
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
            <th>Judul Pertanyaan</th>
            <td>
              <input type="text" id="store_judul_pertanyaan" class="form-control" />
            </td>
          </tr>
          <tr>
            <th>Nama Penyakit (yang dipilih)</th>
            <td>
              <select id="store_daftar_penyakit" class="form-select">
                <option value="default">-- Pilih Penyakit --</option>
              </select>
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
            <th>Judul Pertanyaan</th>
            <td>
              <input type="text" id="edit_judul_pertanyaan" class="form-control" />
            </td>
          </tr>
          <tr>
            <th>Nama Penyakit (yang dipilih)</th>
            <td>
              <select id="edit_daftar_penyakit" class="form-select">
                <option value="default">-- Pilih Penyakit --</option>
              </select>
            </td>
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
            <th>Judul Pertanyaan</th>
            <td id="delete_judul_pertanyaan"></td>
          </tr>
          <tr>
            <th>Nama Penyakit</th>
            <td id="delete_nama_penyakit"></td>
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
  let table;
  $(document).ready( function () {
    table = $('#data_pertanyaan').DataTable({
      processing: true,
      ajax: {
        url: 'crud/index_data_pertanyaan.php',
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + 1;
          }
        },
        { data: 'judul_pertanyaan' },
        { data: 'nama_penyakit' },
        { 
          data: null,
          render: function (data, type, row, meta) {
            return `
              <button type="button" data-id="${row.id_pertanyaan}" onclick="getDataShow(this)" data-bs-toggle="modal" data-bs-target="#modalShow" class="btn btn-secondary p-2"><i class="bi bi-eye-fill"></i></button>
              <button type="button" data-id="${row.id_pertanyaan}" onclick="getDataEdit(this)" data-bs-toggle="modal" data-bs-target="#modalEdit" class="btn btn-warning p-2"><i class="bi bi-pencil-fill"></i></button>
              <button type="button" data-id="${row.id_pertanyaan}" onclick="getDataDelete(this)" data-bs-toggle="modal" data-bs-target="#modalDestroy" class="btn btn-danger p-2"><i class="bi bi-trash-fill"></i></button>
            `;
          }
        }
      ]
    });
    // Load daftar penyakit ke dalam dropdown
    $.get("crud/index_data_penyakit.php", function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        data.data.forEach( penyakit => {
          $('#daftar_penyakit').append(`
            <option value="${penyakit.id_penyakit}">${penyakit.nama_penyakit}</option>
          `);
          $('#store_daftar_penyakit').append(`
            <option value="${penyakit.id_penyakit}">${penyakit.nama_penyakit}</option>
          `);
          $('#edit_daftar_penyakit').append(`
            <option value="${penyakit.id_penyakit}">${penyakit.nama_penyakit}</option>
          `);
        });
      }
    });
    $('#daftar_penyakit').change(function() {
      const id_penyakit = $(this).val();
      let ajaxUrl = 'crud/index_data_pertanyaan.php';
      if(id_penyakit && id_penyakit !== 'default') {
        ajaxUrl += '?id_penyakit=' + id_penyakit;
      }
      table.ajax.url(ajaxUrl).load();
    });
  });

  function addData() {
    const judul_pertanyaan = $('#store_judul_pertanyaan').val();
    const id_penyakit = $('#store_daftar_penyakit').val();

    if(!judul_pertanyaan || id_penyakit == 'default') {
      Swal.fire({
        title: 'Kesalahan',
        text: 'Semua field harus diisi',
        icon: 'error',
      });
      return;
    }

    $.post("crud/store_data_pertanyaan.php", { judul_pertanyaan: judul_pertanyaan, id_penyakit: id_penyakit }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: data.message,
          icon: 'success',
        });
        $('#modalStore').modal('hide');
        $('#data_pertanyaan').DataTable().ajax.reload();
      } else {
        Swal.fire({
          title: 'Gagal',
          text: 'Terjadi kesalahan saat menambahkan data',
          icon: 'error',
        });
      }
    });
  }

  function getDataShow(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_pertanyaan.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#show_judul_pertanyaan').text(data.data.judul_pertanyaan);
        $('#show_nama_penyakit').text(data.data.nama_penyakit);
        $('#show_created_at').text(data.data.created_at);
        $('#show_updated_at').text(data.data.updated_at);
      }
    });
  }

  function getDataEdit(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_pertanyaan.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#edit_judul_pertanyaan').val(data.data.judul_pertanyaan);
        $('#edit_daftar_penyakit').val(data.data.id_penyakit);
        $('#btn-update').attr('data-id', data.data.id_penyakit);
      }
    });
  }

  function updateData() {
    const id = $('#btn-update').attr('data-id');
    const judul_pertanyaan = $('#edit_judul_pertanyaan').val();
    const id_penyakit = $('#edit_daftar_penyakit').val();

    if(!judul_pertanyaan || id_penyakit == 'default') {
      Swal.fire({
        title: 'Kesalahan',
        text: 'Semua field harus diisi',
        icon: 'error',
      });
      return;
    }

    $.post("crud/update_data_pertanyaan.php", { id: id, judul_pertanyaan: judul_pertanyaan, id_penyakit: id_penyakit }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Data pertanyaan berhasil diperbarui',
          icon: 'success',
        });
        $('#modalEdit').modal('hide');
        $('#data_pertanyaan').DataTable().ajax.reload();
      } else {
        Swal.fire({
          title: 'Gagal',
          text: 'Terjadi kesalahan saat memperbarui data',
          icon: 'error',
        });
      }
    });
  }

  function getDataDelete(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_pertanyaan.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#delete_judul_pertanyaan').text(data.data.judul_pertanyaan);
        $('#delete_nama_penyakit').text(data.data.nama_penyakit);
        $('#delete_created_at').text(data.data.created_at);
        $('#delete_updated_at').text(data.data.updated_at);
        $('#btn-delete').attr('data-id', data.data.id_pertanyaan);
      }
    });
  }

  function deleteData() {
    const id = $('#btn-delete').attr('data-id');

    $.post("crud/destroy_data_pertanyaan.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Data penyakit berhasil dihapus',
          icon: 'success',
        });
        $('#modalDestroy').modal('hide');
        $('#data_pertanyaan').DataTable().ajax.reload();
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