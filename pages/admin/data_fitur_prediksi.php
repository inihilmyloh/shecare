<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md-12 mb-4">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Kelola Fitur Prediksi</h4>
      </div>
      <p class="text-muted small">Atur input fields untuk setiap penyakit yang akan digunakan dalam prediksi ML</p>
    </div>

    <!-- Filter Penyakit -->
    <div class="col-md-12 mb-4">
      <div class="row">
        <div class="col-md-6">
          <label for="filter_penyakit" class="form-label">Pilih Penyakit</label>
          <select id="filter_penyakit" class="form-select">
            <option value="">-- Semua Penyakit --</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="filter_status" class="form-label">Status</label>
          <select id="filter_status" class="form-select">
            <option value="">-- Semua Status --</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Add Button -->
    <div class="col-md-12 mb-3">
      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalStoreFitur" data-action="create">
        <i class="bi bi-plus-circle-fill"></i> Tambah Fitur Prediksi
      </button>
    </div>

    <!-- Tabel Fitur -->
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="tabel_fitur_prediksi" class="table table-striped table-hover nowrap">
          <thead class="table-light">
            <tr>
              <th width="5%">No</th>
              <th>Penyakit</th>
              <th>Nama Fitur</th>
              <th>Label</th>
              <th>Tipe Input</th>
              <th>Min-Max</th>
              <th>Urutan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include "pages/layout/admin/footer.php";?>
</div>

<!-- Modal Store/Edit Fitur -->
<div class="modal modal-lg fade" id="modalStoreFitur" tabindex="-1" aria-labelledby="modalStoreFiturLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalStoreFiturLabel">Tambah Fitur Prediksi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- ID Fitur (hidden) -->
          <input type="hidden" id="id_fitur_prediksi" />

          <!-- Penyakit -->
          <div class="col-md-12 mb-3">
            <label for="store_id_penyakit" class="form-label">Penyakit <span class="text-danger">*</span></label>
            <select id="store_id_penyakit" class="form-select" required>
              <option value="">-- Pilih Penyakit --</option>
            </select>
            <small class="text-muted">Penyakit yang akan menggunakan fitur ini</small>
          </div>

          <!-- Nama Fitur -->
          <div class="col-md-12 mb-3">
            <label for="store_nama" class="form-label">Nama Fitur <span class="text-danger">*</span></label>
            <input type="text" id="store_nama" class="form-control" placeholder="contoh: BMI, Tekanan Darah Sistol" required />
            <small class="text-muted">Nama teknis untuk database</small>
          </div>

          <!-- Label -->
          <div class="col-md-12 mb-3">
            <label for="store_label" class="form-label">Label (Tampilan) <span class="text-danger">*</span></label>
            <input type="text" id="store_label" class="form-control" placeholder="contoh: Indeks Massa Tubuh, Tekanan Darah Atas" required />
            <small class="text-muted">Label yang ditampilkan ke user</small>
          </div>

          <!-- Tipe Input -->
          <div class="col-md-12 mb-3">
            <label for="store_tipe" class="form-label">Tipe Input <span class="text-danger">*</span></label>
            <select id="store_tipe" class="form-select" required onchange="handleTipeChange()">
              <option value="">-- Pilih Tipe --</option>
              <option value="number">Number (Range)</option>
              <option value="text">Text Input</option>
              <option value="select">Select Dropdown</option>
              <option value="radio">Radio Buttons</option>
              <option value="textarea">Textarea</option>
              <option value="checkbox">Checkbox</option>
            </select>
          </div>

          <!-- Min-Max (untuk tipe number) -->
          <div class="col-md-6 mb-3" id="minmax_group" style="display: none;">
            <label for="store_min" class="form-label">Nilai Minimum</label>
            <input type="number" id="store_min" class="form-control" step="0.01" />
          </div>
          <div class="col-md-6 mb-3" id="minmax_group_max" style="display: none;">
            <label for="store_max" class="form-label">Nilai Maksimum</label>
            <input type="number" id="store_max" class="form-control" step="0.01" />
          </div>

          <!-- Step (untuk tipe number) -->
          <div class="col-md-6 mb-3" id="step_group" style="display: none;">
            <label for="store_step" class="form-label">Step/Langkah</label>
            <input type="number" id="store_step" class="form-control" step="0.01" value="1" />
            <small class="text-muted">Kenaikan per step pada slider</small>
          </div>

          <!-- Unit -->
          <div class="col-md-6 mb-3">
            <label for="store_unit" class="form-label">Unit</label>
            <input type="text" id="store_unit" class="form-control" placeholder="contoh: kg, cm, mmHg" />
          </div>

          <!-- Pilihan JSON (untuk select/radio/checkbox) -->
          <div class="col-md-12 mb-3" id="pilihan_group" style="display: none;">
            <label for="store_pilihan" class="form-label">Pilihan Options <span class="text-danger">*</span></label>
            <textarea id="store_pilihan" class="form-control" rows="4" placeholder='JSON format: [{"value": "1", "label": "Pilihan 1"}, {"value": "2", "label": "Pilihan 2"}]'></textarea>
            <small class="text-muted">Format JSON untuk opsi pilihan</small>
          </div>

          <!-- Deskripsi -->
          <div class="col-md-12 mb-3">
            <label for="store_deskripsi" class="form-label">Deskripsi</label>
            <textarea id="store_deskripsi" class="form-control" rows="3" placeholder="Keterangan atau instruksi untuk user"></textarea>
          </div>

          <!-- Urutan -->
          <div class="col-md-6 mb-3">
            <label for="store_urutan" class="form-label">Urutan Tampilan</label>
            <input type="number" id="store_urutan" class="form-control" value="1" min="1" />
            <small class="text-muted">Nomor urutan dalam form (1, 2, 3, ...)</small>
          </div>

          <!-- Status -->
          <div class="col-md-6 mb-3">
            <label for="store_is_active" class="form-label">Status</label>
            <select id="store_is_active" class="form-select">
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="storeFitur()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hapus Fitur -->
<div class="modal fade" id="modalDeleteFitur" tabindex="-1" aria-labelledby="modalDeleteFiturLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h1 class="modal-title fs-5" id="modalDeleteFiturLabel">Hapus Fitur Prediksi</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus fitur prediksi ini?</p>
        <p class="mb-0"><strong id="delete_fitur_name"></strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="btnConfirmDelete">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
let dataTable;
let deleteId = null;

// Initialize on document ready
document.addEventListener('DOMContentLoaded', function() {
  loadPenyakitFilter();
  initTable();
  loadData();

  // Event listeners
  document.getElementById('filter_penyakit').addEventListener('change', loadData);
  document.getElementById('filter_status').addEventListener('change', loadData);

  // Reset form hanya ketika modal dibuka via tombol 'Tambah' (data-action="create")
  document.getElementById('modalStoreFitur').addEventListener('show.bs.modal', function(e) {
    if (e.relatedTarget && e.relatedTarget.dataset && e.relatedTarget.dataset.action === 'create') {
      resetForm();
    }
  });
});

// Load penyakit untuk filter dan select
function loadPenyakitFilter() {
  fetch('crud/index_data_penyakit.php')
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        const filterSelect = document.getElementById('filter_penyakit');
        const storeSelect = document.getElementById('store_id_penyakit');
        
        data.data.forEach(penyakit => {
          const option1 = document.createElement('option');
          option1.value = penyakit.id_penyakit;
          option1.textContent = penyakit.nama_penyakit;
          filterSelect.appendChild(option1);

          const option2 = document.createElement('option');
          option2.value = penyakit.id_penyakit;
          option2.textContent = penyakit.nama_penyakit;
          storeSelect.appendChild(option2);
        });
      }
    })
    .catch(error => console.error('Error:', error));
}

// Initialize DataTable
function initTable() {
  dataTable = new DataTable('#tabel_fitur_prediksi', {
    responsive: true,
    paging: true,
    pageLength: 10,
    columnDefs: [
      { orderable: false, targets: 8 } // Disable sort on action column
    ]
  });
}

// Load data fitur
function loadData() {
  const idPenyakit = document.getElementById('filter_penyakit').value;
  const status = document.getElementById('filter_status').value;
  
  let url = 'crud/index_fitur_prediksi.php';
  if (idPenyakit) {
    url += '?id_penyakit=' + idPenyakit;
  }

  fetch(url)
    .then(response => response.json())
    .then(data => {
      renderTable(data.data || []);
    })
    .catch(error => {
      console.error('Error:', error);
      Swal.fire('Error', 'Gagal memuat data fitur', 'error');
    });
}

// Render tabel
function renderTable(data) {
  if (dataTable) {
    dataTable.destroy();
  }

  const tbody = document.getElementById('tbody');
  tbody.innerHTML = '';

  let filteredData = data;
  const statusFilter = document.getElementById('filter_status').value;
  
  if (statusFilter !== '') {
    filteredData = data.filter(item => item.is_active == statusFilter);
  }

  filteredData.forEach((fitur, index) => {
    const row = document.createElement('tr');
    const minMax = fitur.tipe_input === 'number' 
      ? `${fitur.nilai_min} - ${fitur.nilai_max}` 
      : '-';
    
    const statusBadge = fitur.is_active == 1 
      ? '<span class="badge bg-success">Aktif</span>'
      : '<span class="badge bg-secondary">Tidak Aktif</span>';

    row.innerHTML = `
      <td>${index + 1}</td>
      <td>${fitur.nama_penyakit}</td>
      <td><code>${fitur.nama_fitur}</code></td>
      <td>${fitur.label_fitur}</td>
      <td><span class="badge bg-info">${fitur.tipe_input}</span></td>
      <td>${minMax}</td>
      <td><span class="badge bg-warning text-dark">${fitur.urutan}</span></td>
      <td>${statusBadge}</td>
      <td>
        <button class="btn btn-sm btn-info" onclick="editFitur(${fitur.id_fitur})" title="Edit">
          <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-sm btn-danger" onclick="showDeleteModal(${fitur.id_fitur}, '${fitur.label_fitur}')" title="Hapus">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    `;
    tbody.appendChild(row);
  });

  dataTable = new DataTable('#tabel_fitur_prediksi', {
    responsive: true,
    paging: true,
    pageLength: 10,
    columnDefs: [
      { orderable: false, targets: 8 }
    ]
  });
}

// Handle tipe input change
function handleTipeChange() {
  const tipe = document.getElementById('store_tipe').value;
  const minMaxGroup = document.getElementById('minmax_group');
  const minMaxGroupMax = document.getElementById('minmax_group_max');
  const stepGroup = document.getElementById('step_group');
  const pilihanGroup = document.getElementById('pilihan_group');

  // Reset visibility
  minMaxGroup.style.display = 'none';
  minMaxGroupMax.style.display = 'none';
  stepGroup.style.display = 'none';
  pilihanGroup.style.display = 'none';

  if (tipe === 'number') {
    minMaxGroup.style.display = 'block';
    minMaxGroupMax.style.display = 'block';
    stepGroup.style.display = 'block';
  } else if (['select', 'radio', 'checkbox'].includes(tipe)) {
    pilihanGroup.style.display = 'block';
  }
}

// Reset form untuk tambah baru
function resetForm() {
  document.getElementById('id_fitur_prediksi').value = '';
  document.getElementById('modalStoreFiturLabel').textContent = 'Tambah Fitur Prediksi';
  document.getElementById('store_id_penyakit').value = '';
  document.getElementById('store_nama').value = '';
  document.getElementById('store_label').value = '';
  document.getElementById('store_tipe').value = '';
  document.getElementById('store_min').value = '';
  document.getElementById('store_max').value = '';
  document.getElementById('store_step').value = '1';
  document.getElementById('store_unit').value = '';
  document.getElementById('store_pilihan').value = '';
  document.getElementById('store_deskripsi').value = '';
  document.getElementById('store_urutan').value = '1';
  document.getElementById('store_is_active').value = '1';
  document.getElementById('store_id_penyakit').disabled = false;
  handleTipeChange();
}

// Edit fitur
function editFitur(id) {
  fetch(`crud/show_fitur_prediksi.php?id_fitur_prediksi=${id}`)
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        const fitur = data.data;
        // Debug log to help troubleshooting if fields are missing
        console.debug('editFitur response:', data);

        // Support both old and new column names (backwards compatible)
        const idF = fitur.id_fitur ?? fitur.id_fitur_prediksi ?? fitur.id;
        const idPeny = fitur.id_penyakit ?? fitur.id_penyakit;
        const namaVal = fitur.nama_fitur ?? fitur.nama ?? fitur.nama_fitur;
        const labelVal = fitur.label_fitur ?? fitur.label ?? fitur.label_fitur;
        const tipeVal = fitur.tipe_input ?? fitur.tipe;
        const minVal = fitur.nilai_min ?? fitur.min ?? '';
        const maxVal = fitur.nilai_max ?? fitur.max ?? '';
        const stepVal = fitur.step_value ?? fitur.step ?? '1';
        const unitVal = fitur.unit ?? '';
        const pilihanVal = fitur.pilihan_json ?? fitur.pilihan_json ?? '';
        const deskripsiVal = fitur.deskripsi ?? '';
        const urutanVal = fitur.urutan ?? fitur.order ?? 1;
        const isActiveVal = (typeof fitur.is_active !== 'undefined') ? fitur.is_active : 1;

        document.getElementById('id_fitur_prediksi').value = idF || '';
        document.getElementById('modalStoreFiturLabel').textContent = 'Edit Fitur Prediksi';
        document.getElementById('store_id_penyakit').value = idPeny || '';
        document.getElementById('store_id_penyakit').disabled = true; // Tidak boleh diubah
        document.getElementById('store_nama').value = namaVal || '';
        document.getElementById('store_label').value = labelVal || '';
        document.getElementById('store_tipe').value = tipeVal || '';
        document.getElementById('store_min').value = minVal || '';
        document.getElementById('store_max').value = maxVal || '';
        document.getElementById('store_step').value = stepVal || '1';
        document.getElementById('store_unit').value = unitVal || '';
        // If pilihan_json is an object/string, ensure string
        document.getElementById('store_pilihan').value = (typeof pilihanVal === 'object' && pilihanVal !== null) ? JSON.stringify(pilihanVal) : (pilihanVal || '');
        document.getElementById('store_deskripsi').value = deskripsiVal || '';
        document.getElementById('store_urutan').value = urutanVal;
        document.getElementById('store_is_active').value = isActiveVal ? 1 : 0;

        handleTipeChange();

        const modal = new bootstrap.Modal(document.getElementById('modalStoreFitur'));
        modal.show();
      }
    })
    .catch(error => {
      console.error('Error:', error);
      Swal.fire('Error', 'Gagal memuat data fitur', 'error');
    });
}

// Store/Update fitur
function storeFitur() {
  const idFitur = document.getElementById('id_fitur_prediksi').value;
  const idPenyakit = document.getElementById('store_id_penyakit').value;
  const nama = document.getElementById('store_nama').value.trim();
  const label = document.getElementById('store_label').value.trim();
  const tipe = document.getElementById('store_tipe').value;
  const deskripsi = document.getElementById('store_deskripsi').value.trim();
  const urutan = document.getElementById('store_urutan').value;
  const isActive = document.getElementById('store_is_active').value;

  // Validasi
  if (!idPenyakit || !nama || !label || !tipe) {
    Swal.fire('Validasi', 'Silakan isi semua field yang wajib', 'warning');
    return;
  }

  const requestData = {
    id_penyakit: idPenyakit,
    nama: nama,
    label: label,
    tipe_input: tipe,
    deskripsi: deskripsi,
    urutan: urutan,
    is_active: isActive
  };

  // Tambah field berdasarkan tipe
  if (tipe === 'number') {
    const min = parseFloat(document.getElementById('store_min').value);
    const max = parseFloat(document.getElementById('store_max').value);
    const step = parseFloat(document.getElementById('store_step').value);
    
    if (isNaN(min) || isNaN(max)) {
      Swal.fire('Validasi', 'Min dan Max harus diisi untuk tipe number', 'warning');
      return;
    }
    
    requestData.min = min;
    requestData.max = max;
    requestData.step = step;
  } else if (['select', 'radio', 'checkbox'].includes(tipe)) {
    const pilihan = document.getElementById('store_pilihan').value.trim();
    if (!pilihan) {
      Swal.fire('Validasi', 'Pilihan options harus diisi untuk tipe ini', 'warning');
      return;
    }
    
    try {
      JSON.parse(pilihan);
      requestData.pilihan_json = pilihan;
    } catch (e) {
      Swal.fire('Validasi', 'Format JSON pilihan tidak valid', 'warning');
      return;
    }
  }

  const unit = document.getElementById('store_unit').value.trim();
  if (unit) {
    requestData.unit = unit;
  }

  if (idFitur) {
    requestData.id_fitur_prediksi = idFitur;
  }

  // Send request
  fetch('crud/store_fitur_prediksi.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(requestData)
  })
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        Swal.fire('Sukses', data.message, 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalStoreFitur')).hide();
        loadData();
      } else {
        Swal.fire('Error', data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      Swal.fire('Error', 'Gagal menyimpan data', 'error');
    });
}

// Show delete modal
function showDeleteModal(id, name) {
  deleteId = id;
  document.getElementById('delete_fitur_name').textContent = name;
  const modal = new bootstrap.Modal(document.getElementById('modalDeleteFitur'));
  modal.show();
}

// Confirm delete
document.addEventListener('DOMContentLoaded', function() {
  const btnConfirmDelete = document.getElementById('btnConfirmDelete');
  if (btnConfirmDelete) {
    btnConfirmDelete.addEventListener('click', function() {
      if (!deleteId) return;
      
      fetch('crud/delete_fitur_prediksi.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_fitur: deleteId })
      })
        .then(response => response.json())
        .then(data => {
          if (data.status) {
            Swal.fire('Sukses', data.message, 'success');
            bootstrap.Modal.getInstance(document.getElementById('modalDeleteFitur')).hide();
            loadData();
          } else {
            Swal.fire('Error', data.message, 'error');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          Swal.fire('Error', 'Gagal menghapus data', 'error');
        });
    });
  }
});
</script>
