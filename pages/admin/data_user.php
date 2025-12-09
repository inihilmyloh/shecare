<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md 12">
      <table id="data_user" class="cell-border compact stripe hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telp</th>
            <th>Role</th>
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
<div class="modal fade" id="modalShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Nama</th>
            <td id="show_nama_user"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td id="show_email"></td>
          </tr>
          <tr>
            <th>No. Telp</th>
            <td id="show_no_telp"></td>
          </tr>
          <tr>
            <th>Role</th>
            <td id="show_role"></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td id="show_alamat"></td>
          </tr>
          <tr>
            <th>Cara tercatat</th>
            <td id="show_cara_tercatat"></td>
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

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Nama</th>
            <td>
              <input type="text" id="edit_nama_user" class="form-control">
            </td>
          </tr>
          <tr>
            <th>Email</th>
            <td>
              <input type="email" id="edit_email" class="form-control">
            </td>
          </tr>
          <tr>
            <th>No. Telp</th>
            <td>
              <input type="text" id="edit_no_telp" class="form-control">
            </td>
          </tr>
          <tr>
            <th>Role</th>
            <td>
              <select id="edit_role" class="form-select">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>
              <input type="text" id="edit_alamat" class="form-control">
            </td>
          </tr>
          <tr>
            <th>Password (kosongi jika tidak mau diubah)</th>
            <td>
              <input type="password" id="edit_password" class="form-control">
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
            <th>Nama</th>
            <td id="delete_nama_user"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td id="delete_email"></td>
          </tr>
          <tr>
            <th>No. Telp</th>
            <td id="delete_no_telp"></td>
          </tr>
          <tr>
            <th>Role</th>
            <td id="delete_role"></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td id="delete_alamat"></td>
          </tr>
          <tr>
            <th>Cara tercatat</th>
            <td id="delete_cara_tercatat"></td>
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
    $('#data_user').DataTable({
      processing: true,
      ajax: {
        url: 'crud/index_data_user.php',
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + 1;
          }
        },
        { data: 'nama_user' },
        { data: 'email' },
        { data: 'no_telp' },
        { data: 'role' },
        { 
          data: null,
          render: function (data, type, row, meta) {
            return `
              <button type="button" data-id="${row.id_user}" onclick="getDataShow(this)" data-bs-toggle="modal" data-bs-target="#modalShow" class="btn btn-secondary p-2"><i class="bi bi-eye-fill"></i></button>
              <button type="button" data-id="${row.id_user}" onclick="getDataEdit(this)" data-bs-toggle="modal" data-bs-target="#modalEdit" class="btn btn-warning p-2"><i class="bi bi-pencil-fill"></i></button>
              <button type="button" data-id="${row.id_user}" onclick="getDataDelete(this)" data-bs-toggle="modal" data-bs-target="#modalDestroy" class="btn btn-danger p-2"><i class="bi bi-trash-fill"></i></button>
            `;
          }
        }
      ]
    });
  });

  function getDataShow(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_user.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#show_nama_user').text(data.data.nama_user);
        $('#show_email').text(data.data.email);
        $('#show_no_telp').text(data.data.no_telp);
        $('#show_role').text(data.data.role);
        $('#show_alamat').text(data.data.alamat);
        $('#show_cara_tercatat').text(data.data.cara_tercatat);
        $('#show_created_at').text(data.data.created_at);
        $('#show_updated_at').text(data.data.updated_at);
      }
    });
  }

  function getDataEdit(btn) {
    const id = btn.getAttribute('data-id');
    $.get("crud/show_data_user.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#edit_nama_user').val(data.data.nama_user);
        $('#edit_email').val(data.data.email);
        $('#edit_no_telp').val(data.data.no_telp);
        $('#edit_role').val(data.data.role);
        $('#edit_alamat').val(data.data.alamat);
        $('#btn-update').attr('data-id', data.data.id_user);
      }
    });
  }

  function updateData() {
    const id = $('#btn-update').attr('data-id');
    const nama = $('#edit_nama_user').val();
    const email = $('#edit_email').val();
    const no_telp = $('#edit_no_telp').val();
    const role = $('#edit_role').val();
    const alamat = $('#edit_alamat').val();
    const password = $('#edit_password').val();

    $.post("crud/update_data_user.php", {
      id: id,
      nama: nama,
      email: email,
      no_telp: no_telp,
      role: role,
      alamat: alamat,
      password: password
    }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: data.message,
          icon: 'success',
        });
        $('#modalEdit').modal('hide');
        $('#data_user').DataTable().ajax.reload();
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
    $.get("crud/show_data_user.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        $('#delete_nama_user').text(data.data.nama_user);
        $('#delete_email').text(data.data.email);
        $('#delete_no_telp').text(data.data.no_telp);
        $('#delete_role').text(data.data.role);
        $('#delete_alamat').text(data.data.alamat);
        $('#delete_cara_tercatat').text(data.data.cara_tercatat);
        $('#delete_created_at').text(data.data.created_at);
        $('#delete_updated_at').text(data.data.updated_at);
        $('#btn-delete').attr('data-id', data.data.id_user);
      }
    });
  }

  function deleteData() {
    const id = $('#btn-delete').attr('data-id');

    $.post("crud/destroy_data_user.php", { id: id }, function(response) {
      let data = JSON.parse(response);
      if(data.status) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Data user berhasil dihapus',
          icon: 'success',
        });
        $('#modalDestroy').modal('hide');
        $('#data_user').DataTable().ajax.reload();
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