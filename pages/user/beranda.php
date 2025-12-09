<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <?php include 'pages/layout/user/navbar.php' ?>

  <div class="site-blocks-cover overlay" style="background-image: url(assets/user/images/hero_bg_1.jpg);" data-aos="fade"
    data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">

        <div class="col-md-10">

          <div class="row justify-content-center mb-4">
            <div class="col-md-10 text-center">
              <h1 data-aos="fade-up" class="mb-5">Kami hadir untuk menjadikan setiap wanita merasa <span class="typed-words"></span></h1>

              <p data-aos="fade-up" data-aos-delay="100"><a href="?hal=layanan_penyakit" class="btn btn-primary btn-pill">Mulai Analisa</a>
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="block-quick-info-2">
    <div class="container">
      <div class="block-quick-info-2-inner">
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="d-flex quick-info-2">
              <span class="icon icon-home mr-3"></span>
              <div class="text">
                <strong class="d-block heading">Visit our Location</strong>
                <span class="excerpt">2875 Beechwood Drive</span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="d-flex quick-info-2">
              <span class="icon icon-phone mr-3"></span>
              <div class="text">
                <strong class="d-block heading">Call us today</strong>
                <span class="excerpt"><a href="#">+(123) 456 7890</a></span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="d-flex quick-info-2">
              <span class="icon icon-envelope mr-3"></span>
              <div class="text">
                <strong class="d-block heading">Send us a message</strong>
                <span class="excerpt"><a href="#">info@mysite.com</a></span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="d-flex quick-info-2">
              <span class="icon icon-clock-o mr-3"></span>
              <div class="text">
                <strong class="d-block heading">Opening hours</strong>
                <span class="excerpt">Mon-Fri 7:AM - 5PM</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="block-services-1 py-5" id="layanan_penyakit_section">
    <div class="container">
      <div class="row" id="daftar_penyakit">
        <div class="mb-4 mb-lg-0 col-sm-6 col-md-6 col-lg-3">
          <h3 class="mb-3">Periksa Penyakit</h3>
          <p>Solusi cerdas untuk wanita modern yang peduli pada kesehatannya.</p>
          <p><a href="?hal=layanan_penyakit" class="d-inline-flex align-items-center block-service-1-more"><span>Lihat semua layanan penyakit</span>
              <span class="icon-keyboard_arrow_right icon"></span></a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="block-half-content-1 d-block d-lg-flex mt-5" id="about_section">
    <div class="block-half-content-img" style="background-image: url('assets/user/images/hero_bg_1.jpg')">

    </div>
    <div class="block-half-content-text bg-primary">
      <div class="block-half-content-text-inner">
        <h2 class="block-half-content-heading mb-4">Kenapa pilih kami?</h2>
        <div class="block-half-content-excerpt">
          <p class="lead">Setiap wanita punya cerita dan tantangannya sendiri. Dari masa remaja, kehamilan, hingga menopause—tubuh wanita terus berkembang dan berubah. SheCare hadir untuk mendukungmu di setiap tahap kehidupan, dengan informasi, edukasi, dan layanan yang bisa kamu percayai.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section bg-light" id="artikel_section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12 text-center">
          <h2 class="site-section-heading text-center font-secondary">Baca Artikel</h2>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 row justify-content-center mb-4">
          <div class="col-md-4 mx-2">
            <input type="text" name="" id="cari_artikel_input" class="form-control rounded" placeholder="Masukkan kata kunci artikel">
          </div>
          <button type="button" id="cari_artikel" class="btn btn-primary btn-sm rounded" onclick="searchQuery()">Cari Artikel</button>
        </div>
        <div class="col-md-12 row" id="daftar_artikel_google">
          <!-- Artikel akan dimuat di sini -->
        </div>
      </div>
    </div>
  </div>

  <!-- Lokasi Section with Leaflet Map -->
  <div class="site-section" id="lokasi_section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12 text-center">
          <h2 class="site-section-heading text-center font-secondary">Lokasi Bidan atau Rumah Sakit</h2>
          <p>Temukan lokasi Bidan atau Rumah Sakit terdekat dengan Anda</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 mb-4">
          <div id="map_lokasi" style="height: 500px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"></div>
        </div>
        <div class="col-md-4">
          <div id="daftar_lokasi" style="max-height: 500px; overflow-y: auto;">
            <!-- Daftar lokasi akan dimuat di sini -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'pages/layout/user/footer.php'; ?>
</div>

<script>
  $(document).ready(function() {
    $.ajax({
      url: 'crud/index_data_penyakit.php?limit=3',
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        let penyakitHTML = '';
        response.data.forEach(function(penyakit) {
          penyakitHTML += `
            <div class="mb-4 mb-lg-0 col-sm-6 col-md-6 col-lg-3">
              <div class="block-service-1-card">
              <a href="#" class="thumbnail-link d-block mb-4">
                <img src="data:image/jpeg;base64,${penyakit.thumbnail}" alt="Image" class="img-fluid" style="width:100%;height:200px;object-fit:cover;display:block;">
              </a>
              <h3 class="block-service-1-heading mb-3"><a href="#">${penyakit.nama_penyakit}</a></h3>
              <div class="block-service-1-excerpt">
                <p>${penyakit.deskripsi_penyakit.substring(0, 100)}...</p>
              </div>
              <p><a href="?hal=detail_layanan_penyakit&id=${penyakit.id_penyakit}" class="d-inline-flex align-items-center block-service-1-more"><span>Selengkapnya</span>
                <span class="icon-keyboard_arrow_right icon"></span></a></p>
              </div>
            </div>
          `;
        });
        $('#daftar_penyakit').append(penyakitHTML);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });

    const apiUrl = `crud/index_data_artikel_google.php?limit=6`;
    $.ajax({
      url: apiUrl,
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        let artikelHTML = '';
        response.forEach(function(artikel) {
          artikelHTML += `
            <div class="col-sm-6 col-md-6 col-lg-4 my-3">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">${artikel.title}</h5>
                  <p class="card-text">${artikel.description}</p>
                </div>
              </div>
            </div>
          `;
        });
        $('#daftar_artikel_google').html(artikelHTML);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });
  });

  function searchQuery() {
    const query = $('#cari_artikel_input').val();
    if (!query) {
      alert('Please enter a search term.');
      return;
    }

    const apiUrl = `crud/index_data_artikel_google.php?query_rss=${encodeURIComponent(query)}&limit=6`;
    $.ajax({
      url: apiUrl,
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        let artikelHTML = '';
        response.forEach(function(artikel) {
          artikelHTML += `
            <div class="col-sm-6 col-md-6 col-lg-4 my-3">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">${artikel.title}</h5>
                  <p class="card-text">${artikel.description}</p>
                </div>
              </div>
            </div>
          `;
        });
        $('#daftar_artikel_google').html(artikelHTML);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  // Load and display lokasi data with Leaflet map
  let mapLokasi = null;
  let lokasiMarkers = [];
  let userMarker = null;

  function initMapLokasi() {
    if(mapLokasi) return;
    mapLokasi = L.map('map_lokasi').setView([-6.200000, 106.816666], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(mapLokasi);

    // Get user location
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;
        
        // Create custom icon for user location (blue circle)
        const userIcon = L.divIcon({
          className: 'user-location-marker',
          html: `<div style="width: 30px; height: 30px; background-color: #007bff; border: 3px solid white; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
          iconSize: [30, 30],
          popupAnchor: [0, -15]
        });
        
        userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(mapLokasi);
        userMarker.bindPopup('<div><strong>Lokasi Anda</strong><br>' + userLat.toFixed(6) + ', ' + userLng.toFixed(6) + '</div>');
      }, function(error) {
        console.log('Geolocation error:', error);
        // Silently fail - map will still work with default center
      });
    }

    // Load lokasi data
    $.ajax({
      url: 'crud/index_data_lokasi.php',
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        if(response.status && response.data.length > 0) {
          let daftarHTML = '';
          let bounds = [];

          response.data.forEach(function(lokasi) {
            const lat = parseFloat(lokasi.latitude);
            const lng = parseFloat(lokasi.longitude);

            if(!isNaN(lat) && !isNaN(lng)) {
              // Add marker to map
              const marker = L.marker([lat, lng]).addTo(mapLokasi);
              const popupContent = `
                <div style="min-width: 280px;">
                  <img src="crud/get_thumbnail_lokasi.php?id=${lokasi.id_lokasi}" alt="Thumbnail" style="width:100%; height:150px; object-fit:cover; border-radius:4px; margin-bottom:10px;">
                  <h6 style="margin-bottom:8px; margin-top:0;">${lokasi.nama_lokasi}</h6>
                  <p style="margin-bottom:5px;"><small><i class="icon-map-marker"></i> ${lokasi.alamat || 'N/A'}</small></p>
                  <p style="margin-bottom:5px;"><small><strong>Lat:</strong> ${lat.toFixed(6)} | <strong>Lng:</strong> ${lng.toFixed(6)}</small></p>
                  ${lokasi.deskripsi ? `<p style="margin-bottom:0;"><small class="text-muted">${lokasi.deskripsi}</small></p>` : ''}
                </div>
              `;
              marker.bindPopup(popupContent, { maxWidth: 300 });
              lokasiMarkers.push(marker);
              bounds.push([lat, lng]);
            }

            // Add to list
            daftarHTML += `
              <div class="card mb-3 shadow-sm">
                <div class="card-body">
                  <h6 class="card-title text-primary">${lokasi.nama_lokasi}</h6>
                  <p class="card-text small mb-2"><i class="icon-map-marker"></i> ${lokasi.alamat || 'N/A'}</p>
                  <p class="card-text small">
                    <strong>Koordinat:</strong> ${lat.toFixed(4)}, ${lng.toFixed(4)}
                  </p>
                  ${lokasi.deskripsi ? `<p class="card-text small text-muted">${lokasi.deskripsi}</p>` : ''}
                </div>
              </div>
            `;
          });

          $('#daftar_lokasi').html(daftarHTML);

          // Fit map bounds
          if(bounds.length > 0) {
            const featureGroup = L.featureGroup(lokasiMarkers);
            mapLokasi.fitBounds(featureGroup.getBounds().pad(0.1));
          }
        } else {
          $('#daftar_lokasi').html('<p class="text-muted">Tidak ada data lokasi</p>');
        }
      },
      error: function(xhr, status, error) {
        console.error('Error fetching lokasi:', error);
        $('#daftar_lokasi').html('<p class="text-danger">Gagal memuat data lokasi</p>');
      }
    });
  }

  // Initialize map when page is loaded or visible
  if(document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMapLokasi);
  } else {
    initMapLokasi();
  }
</script>