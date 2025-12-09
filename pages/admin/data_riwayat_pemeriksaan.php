<div class="container-fluid py-4">
  <div class="row p-4 bg-white rounded shadow">
    <div class="col-md-12">
      <h4 class="mb-3">Data Riwayat Pemeriksaan</h4>
    </div>
    <div class="col-md-12">
      <table id="data_riwayat_pemeriksaan" class="cell-border compact stripe hover nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Umur</th>
            <th>No. Telepon</th>
            <th>Penyakit</th>
            <th>Tanggal Pemeriksaan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tbody"></tbody>
      </table>
    </div>
  </div>
  <?php include "pages/layout/admin/footer.php";?>
</div>

<!-- Modal Show Detail -->
<div class="modal modal-xl fade" id="modalShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Riwayat Pemeriksaan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table">
          <tr>
            <th width="30%">Nama Pasien</th>
            <td id="show_nama"></td>
          </tr>
          <tr>
            <th>Umur</th>
            <td id="show_umur"></td>
          </tr>
          <tr>
            <th>No. Telepon</th>
            <td id="show_no_telp"></td>
          </tr>
          <tr>
            <th>Penyakit</th>
            <td id="show_nama_penyakit"></td>
          </tr>
          <tr>
            <th>Tanggal Pemeriksaan</th>
            <td id="show_created_at"></td>
          </tr>
          <tr>
            <th>Jawaban Pertanyaan</th>
            <td id="show_jawaban"></td>
          </tr>
          <tr>
            <th>Hasil Prediksi</th>
            <td id="show_hasil_prediksi"></td>
          </tr>
          <tr>
            <th>Skor Prediksi</th>
            <td id="show_skor_prediksi"></td>
          </tr>
          <tr>
            <th>Model Version</th>
            <td id="show_model_version"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#data_riwayat_pemeriksaan').DataTable({
      processing: true,
      ajax: {
        url: 'crud/index_riwayat_pemeriksaan.php',
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + 1;
          }
        },
        { data: 'nama' },
        { data: 'umur' },
        { data: 'no_telp' },
        { data: 'nama_penyakit' },
        { 
          data: 'created_at',
          render: function (data) {
            return data ? new Date(data).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' }) : '-';
          }
        },
        { 
          data: null,
          render: function (data, type, row, meta) {
            return `
              <button type="button" data-id="${row.id_pemeriksaan}" onclick="getDataShow(this)" data-bs-toggle="modal" data-bs-target="#modalShow" class="btn btn-secondary p-2"><i class="bi bi-eye-fill"></i></button>
            `;
          }
        }
      ]
    });
  });

  function getDataShow(button) {
    const id = $(button).data('id');
    
    $.ajax({
      url: 'crud/show_riwayat_pemeriksaan.php',
      type: 'GET',
      data: { id: id },
      dataType: 'json',
      success: function(response) {
        console.log('Response:', response);
        if(response.status) {
          const data = response.data;
          console.log('Jawaban array:', data.jawaban_array);
          console.log('Raw jawaban:', data.jawaban);
          
          $('#show_nama').text(data.nama || '-');
          $('#show_umur').text(data.umur || '-');
          $('#show_no_telp').text(data.no_telp || '-');
          $('#show_nama_penyakit').text(data.nama_penyakit || '-');
          $('#show_created_at').text(data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' }) : '-');
          
          // Tampilkan jawaban dalam format list
          let jawabanHTML = '<div style="max-height: 300px; overflow-y: auto;">';
          if (data.jawaban_array && data.jawaban_array.length > 0) {
            jawabanHTML += '<ol style="padding-left: 20px;">';
            data.jawaban_array.forEach((item, index) => {
              jawabanHTML += `
                <li style="margin-bottom: 10px;">
                  <strong>${item.pertanyaan}</strong><br/>
                  <span style="color: #007bff; font-weight: bold;">Jawaban: ${item.deskripsi} (${item.nilai})</span>
                </li>
              `;
            });
            jawabanHTML += '</ol>';
          } else {
            jawabanHTML += '<p class="text-muted">Tidak ada jawaban (jawaban_array: ' + (data.jawaban_array ? data.jawaban_array.length : 0) + ')</p>';
          }
          jawabanHTML += '</div>';
          $('#show_jawaban').html(jawabanHTML);
          
          $('#show_hasil_prediksi').text(data.hasil_prediksi || '-');
          $('#show_skor_prediksi').text(data.skor_prediksi !== null ? parseFloat(data.skor_prediksi).toFixed(4) : '-');
          $('#show_model_version').text(data.model_version || '-');
        } else {
          Swal.fire('Error', 'Gagal memuat data', 'error');
        }
      },
      error: function() {
        Swal.fire('Error', 'Gagal memuat data', 'error');
      }
    });
  }
</script>
