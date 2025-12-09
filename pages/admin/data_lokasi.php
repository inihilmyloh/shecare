<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
      <h4>Data Lokasi</h4>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Lokasi</button>
    </div>
    <div class="col-md-12">
      <table id="data_lokasi" class="cell-border compact stripe hover" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tbody"></tbody>
      </table>
    </div>
  </div>
  <?php include "pages/layout/admin/footer.php";?>
</div>

<!-- Modal Create -->
<div class="modal modal-lg fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateLabel">Tambah Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-create" enctype="multipart/form-data">
          <div class="mb-2">
            <label class="form-label">Nama Lokasi</label>
            <input type="text" name="nama_lokasi" id="create_nama" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" id="create_alamat" class="form-control" required>
          </div>
          <div class="mb-2 row">
            <div class="col">
              <label class="form-label">Latitude</label>
              <input type="text" name="latitude" id="create_lat" class="form-control" required>
            </div>
            <div class="col">
              <label class="form-label">Longitude</label>
              <input type="text" name="longitude" id="create_lng" class="form-control" required>
            </div>
          </div>
          <div class="mb-2">
            <button type="button" id="create_use_my_location" class="btn btn-sm btn-outline-secondary mb-2">Gunakan lokasi saya</button>
            <div id="map_create" style="height:300px; width:100%;"></div>
          </div>
          <div class="mb-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="create_deskripsi" class="form-control" rows="3" required></textarea>
          </div>
          <div class="mb-2">
            <label class="form-label">Thumbnail (gambar)</label>
            <input type="file" name="thumbnail" id="create_thumbnail" accept="image/*" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btn-store" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Show -->
<div class="modal modal-lg fade" id="modalShow" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalShowLabel">Detail Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 text-center">
          <img id="show_thumbnail" src="" alt="Thumbnail" style="max-width:100%; max-height:250px; display:none;" />
        </div>
        <table class="table">
          <tr>
            <th>Nama</th>
            <td id="show_nama"></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td id="show_alamat"></td>
          </tr>
          <tr>
            <th>Latitude</th>
            <td id="show_lat"></td>
          </tr>
          <tr>
            <th>Longitude</th>
            <td id="show_lng"></td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td id="show_deskripsi"></td>
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
<div class="modal modal-lg fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">Edit Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit" enctype="multipart/form-data">
          <input type="hidden" id="edit_id" name="id">
          <div class="mb-2">
            <label class="form-label">Nama Lokasi</label>
            <input type="text" name="nama_lokasi" id="edit_nama" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" id="edit_alamat" class="form-control" required>
          </div>
          <div class="mb-2 row">
            <div class="col">
              <label class="form-label">Latitude</label>
              <input type="text" name="latitude" id="edit_lat" class="form-control" required>
            </div>
            <div class="col">
              <label class="form-label">Longitude</label>
              <input type="text" name="longitude" id="edit_lng" class="form-control" required>
            </div>
          </div>
          <div class="mb-2">
            <button type="button" id="edit_use_my_location" class="btn btn-sm btn-outline-secondary mb-2">Gunakan lokasi saya</button>
            <div id="map_edit" style="height:300px; width:100%;"></div>
          </div>
          <div class="mb-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3" required></textarea>
          </div>
          <div class="mb-2">
            <label class="form-label">Ganti Thumbnail (biarkan kosong untuk tidak mengubah)</label>
            <input type="file" name="thumbnail" id="edit_thumbnail" accept="image/*" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btn-update" class="btn btn-success">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDestroy" tabindex="-1" aria-labelledby="modalDestroyLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDestroyLabel">Hapus Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Apakah anda yakin ingin menghapus lokasi ini?</h5>
        <p id="delete_nama"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btn-delete" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function () {
    $('#data_lokasi').DataTable({
      processing: true,
      ajax: {
        url: 'crud/index_data_lokasi.php',
        dataSrc: 'data'
      },
      columns: [
        { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
        { data: 'nama_lokasi' },
        { data: 'alamat' },
        { data: 'latitude' },
        { data: 'longitude' },
        { data: null, render: function (data, type, row, meta) {
            return `
              <button type="button" data-id="${row.id_lokasi}" onclick="getDataShow(this)" data-bs-toggle="modal" data-bs-target="#modalShow" class="btn btn-secondary p-2"><i class="bi bi-eye-fill"></i></button>
              <button type="button" data-id="${row.id_lokasi}" onclick="getDataEdit(this)" data-bs-toggle="modal" data-bs-target="#modalEdit" class="btn btn-warning p-2"><i class="bi bi-pencil-fill"></i></button>
              <button type="button" data-id="${row.id_lokasi}" onclick="getDataDelete(this)" data-bs-toggle="modal" data-bs-target="#modalDestroy" class="btn btn-danger p-2"><i class="bi bi-trash-fill"></i></button>
            `;
          }
        }
      ]
    });

    // store
    $('#btn-store').on('click', function() {
      let form = new FormData($('#form-create')[0]);
      $.ajax({
        url: 'crud/store_data_lokasi.php',
        data: form,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(response) {
          let data = JSON.parse(response);
          if(data.status) {
            Swal.fire('Berhasil', 'Lokasi berhasil ditambahkan', 'success');
            $('#modalCreate').modal('hide');
            $('#data_lokasi').DataTable().ajax.reload();
            $('#form-create')[0].reset();
          } else {
            Swal.fire('Gagal', data.message || 'Gagal menambahkan lokasi', 'error');
          }
        }
      });
    });

    // update
    $('#btn-update').on('click', function() {
      let form = new FormData($('#form-edit')[0]);
      $.ajax({
        url: 'crud/update_data_lokasi.php',
        data: form,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(response) {
          let data = JSON.parse(response);
          if(data.status) {
            Swal.fire('Berhasil', data.message || 'Berhasil diperbarui', 'success');
            $('#modalEdit').modal('hide');
            $('#data_lokasi').DataTable().ajax.reload();
          } else {
            Swal.fire('Gagal', data.message || 'Gagal memperbarui lokasi', 'error');
          }
        }
      });
    });

    // delete
    $('#btn-delete').on('click', function() {
      const id = $(this).attr('data-id');
      $.post('crud/destroy_data_lokasi.php', { id: id }, function(response) {
        let data = JSON.parse(response);
        if(data.status) {
          Swal.fire('Berhasil', 'Lokasi berhasil dihapus', 'success');
          $('#modalDestroy').modal('hide');
          $('#data_lokasi').DataTable().ajax.reload();
        } else {
          Swal.fire('Gagal', data.message || 'Gagal menghapus lokasi', 'error');
        }
      });
    });
  });

  function getDataShow(btn) {
    const id = btn.getAttribute('data-id');
    $.get('crud/show_data_lokasi.php', { id: id }, function(response) {
      let res = JSON.parse(response);
      if(res.status) {
        $('#show_nama').text(res.data.nama_lokasi || '');
        $('#show_alamat').text(res.data.alamat || '');
        $('#show_lat').text(res.data.latitude || '');
        $('#show_lng').text(res.data.longitude || '');
        $('#show_deskripsi').text(res.data.deskripsi || '');
        $('#show_created_at').text(res.data.created_at || '');
        $('#show_updated_at').text(res.data.updated_at || '');
        // set thumbnail src
        $('#show_thumbnail').hide();
        if(res.data.has_thumbnail) {
          $('#show_thumbnail').attr('src', 'crud/get_thumbnail_lokasi.php?id=' + id).show();
        }
      }
    });
  }

  function getDataEdit(btn) {
    const id = btn.getAttribute('data-id');
    $.get('crud/show_data_lokasi.php', { id: id }, function(response) {
      let res = JSON.parse(response);
      if(res.status) {
        $('#edit_id').val(res.data.id_lokasi);
        $('#edit_nama').val(res.data.nama_lokasi);
        $('#edit_alamat').val(res.data.alamat);
        $('#edit_lat').val(res.data.latitude);
        $('#edit_lng').val(res.data.longitude);
        $('#edit_deskripsi').val(res.data.deskripsi);
        $('#btn-update').attr('data-id', res.data.id_lokasi);
      }
    });
  }

  function getDataDelete(btn) {
    const id = btn.getAttribute('data-id');
    $.get('crud/show_data_lokasi.php', { id: id }, function(response) {
      let res = JSON.parse(response);
      if(res.status) {
        $('#delete_nama').text(res.data.nama_lokasi || '');
        $('#btn-delete').attr('data-id', res.data.id_lokasi);
      }
    });
  }

  // Leaflet maps for selecting coordinates
  let mapCreate = null, markerCreate = null;
  let mapEdit = null, markerEdit = null;

  function initMapCreate() {
    if(mapCreate) return;
    mapCreate = L.map('map_create').setView([-8.168756, 113.702105], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(mapCreate);

    mapCreate.on('click', function(e) {
      const lat = e.latlng.lat.toFixed(6);
      const lng = e.latlng.lng.toFixed(6);
      if(markerCreate) { markerCreate.setLatLng(e.latlng); } else { markerCreate = L.marker(e.latlng).addTo(mapCreate); }
      $('#create_lat').val(lat);
      $('#create_lng').val(lng);
    });
  }

  function initMapEdit() {
    if(mapEdit) return;
    mapEdit = L.map('map_edit').setView([-8.168756, 113.702105], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(mapEdit);

    mapEdit.on('click', function(e) {
      const lat = e.latlng.lat.toFixed(6);
      const lng = e.latlng.lng.toFixed(6);
      if(markerEdit) { markerEdit.setLatLng(e.latlng); } else { markerEdit = L.marker(e.latlng).addTo(mapEdit); }
      $('#edit_lat').val(lat);
      $('#edit_lng').val(lng);
    });
  }

  // when modals open, initialize maps and if inputs have values, set marker
  $('#modalCreate').on('shown.bs.modal', function () {
    initMapCreate();
    // if coords present, set view
    const lat = parseFloat($('#create_lat').val());
    const lng = parseFloat($('#create_lng').val());
    if(!isNaN(lat) && !isNaN(lng)) {
      const latlng = L.latLng(lat, lng);
      mapCreate.setView(latlng, 15);
      if(markerCreate) markerCreate.setLatLng(latlng); else markerCreate = L.marker(latlng).addTo(mapCreate);
    }
  });

  $('#modalEdit').on('shown.bs.modal', function () {
    initMapEdit();
    const lat = parseFloat($('#edit_lat').val());
    const lng = parseFloat($('#edit_lng').val());
    if(!isNaN(lat) && !isNaN(lng)) {
      const latlng = L.latLng(lat, lng);
      mapEdit.setView(latlng, 15);
      if(markerEdit) markerEdit.setLatLng(latlng); else markerEdit = L.marker(latlng).addTo(mapEdit);
    }
  });

  // buttons to use browser geolocation
  $('#create_use_my_location').on('click', function() {
    if(!navigator.geolocation) { Swal.fire('Info', 'Geolocation tidak didukung oleh browser Anda', 'info'); return; }
    navigator.geolocation.getCurrentPosition(function(pos) {
      const lat = pos.coords.latitude.toFixed(6);
      const lng = pos.coords.longitude.toFixed(6);
      $('#create_lat').val(lat); $('#create_lng').val(lng);
      initMapCreate();
      const latlng = L.latLng(lat, lng);
      mapCreate.setView(latlng, 15);
      if(markerCreate) markerCreate.setLatLng(latlng); else markerCreate = L.marker(latlng).addTo(mapCreate);
    }, function(err){ Swal.fire('Gagal', 'Tidak dapat mengambil lokasi Anda', 'error'); });
  });

  $('#edit_use_my_location').on('click', function() {
    if(!navigator.geolocation) { Swal.fire('Info', 'Geolocation tidak didukung oleh browser Anda', 'info'); return; }
    navigator.geolocation.getCurrentPosition(function(pos) {
      const lat = pos.coords.latitude.toFixed(6);
      const lng = pos.coords.longitude.toFixed(6);
      $('#edit_lat').val(lat); $('#edit_lng').val(lng);
      initMapEdit();
      const latlng = L.latLng(lat, lng);
      mapEdit.setView(latlng, 15);
      if(markerEdit) markerEdit.setLatLng(latlng); else markerEdit = L.marker(latlng).addTo(mapEdit);
    }, function(err){ Swal.fire('Gagal', 'Tidak dapat mengambil lokasi Anda', 'error'); });
  });
</script>