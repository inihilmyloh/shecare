<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
          </div>

          <!-- Step 3: Prediction Features (dynamically generated) -->
          <div id="step_3" class="step-content" style="display: none;">
            <div class="step-header">
              <span class="step-badge">3</span>
              <h4>Input Fitur untuk Prediksi</h4>
            </div>
            <div id="daftar_fitur_prediksi">
              <p class="text-muted">Memuat fitur prediksi...</p>
            </div>
          </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <!-- Custom Slider Styling -->
  <style>
    .slider-container {
      display: flex;
      align-items: center;
      gap: 15px;
      margin: 20px 0;
    }

    .slider-label {
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      white-space: nowrap;
      min-width: 80px;
    }

    .slider-label.start {
      text-align: right;
      color: #dc3545;
    }

    .slider-label.end {
      text-align: left;
      color: #28a745;
    }

    .slider-wrapper {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .pertanyaan-range {
      flex: 1;
      height: 8px;
      -webkit-appearance: none;
      appearance: none;
      background: linear-gradient(to right, #e9ecef 0%, #e9ecef 100%);
      border-radius: 5px;
      outline: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    /* Chrome/Safari Slider Thumb */
    .pertanyaan-range::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 24px;
      height: 24px;
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      border: 3px solid white;
      border-radius: 50%;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 123, 255, 0.4);
      transition: all 0.2s ease;
    }

    .pertanyaan-range::-webkit-slider-thumb:hover {
      transform: scale(1.2);
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.6);
    }

    .pertanyaan-range::-webkit-slider-thumb:active {
      transform: scale(1.15);
    }

    /* Firefox Slider Thumb */
    .pertanyaan-range::-moz-range-thumb {
      width: 24px;
      height: 24px;
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      border: 3px solid white;
      border-radius: 50%;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 123, 255, 0.4);
      transition: all 0.2s ease;
    }

    .pertanyaan-range::-moz-range-thumb:hover {
      transform: scale(1.2);
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.6);
    }

    /* Firefox Track */
    .pertanyaan-range::-moz-range-track {
      background: transparent;
      border: none;
    }

    .pertanyaan-range::-moz-range-progress {
      background: linear-gradient(to right, #007bff 0%, #0056b3 100%);
      height: 8px;
      border-radius: 5px;
    }

    .slider-value {
      min-width: 45px;
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      color: #007bff;
      background: rgba(0, 123, 255, 0.1);
      padding: 8px 12px;
      border-radius: 6px;
      transition: all 0.2s ease;
    }

    .slider-value.value-1 { color: #dc3545; background: rgba(220, 53, 69, 0.1); }
    .slider-value.value-2 { color: #fd7e14; background: rgba(253, 126, 20, 0.1); }
    .slider-value.value-3 { color: #ffc107; background: rgba(255, 193, 7, 0.1); }
    .slider-value.value-4 { color: #20c997; background: rgba(32, 201, 151, 0.1); }
    .slider-value.value-5 { color: #28a745; background: rgba(40, 167, 69, 0.1); }

    .slider-description {
      font-size: 11px;
      color: #6c757d;
      margin-top: 5px;
      padding-left: 90px;
      font-style: italic;
    }

    .question-item {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      border-left: 4px solid #007bff;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .question-item:hover {
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
      border-left-color: #0056b3;
    }

    .question-title {
      font-size: 15px;
      font-weight: 600;
      color: #212529;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }

    .question-number {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 28px;
      height: 28px;
      background: #007bff;
      color: white;
      border-radius: 50%;
      font-size: 13px;
      font-weight: bold;
      margin-right: 12px;
      flex-shrink: 0;
    }

    /* Card Form Styling */
    .floating-form-card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 123, 255, 0.15);
      border: none;
      transition: all 0.3s ease;
      position: relative;
      overflow: visible;
    }

    .floating-form-card:hover {
      box-shadow: 0 15px 50px rgba(0, 123, 255, 0.25);
      transform: translateY(-2px);
    }

    .progress-bar-wrapper {
      background: linear-gradient(to right, #007bff 0%, #007bff 0%, #e9ecef 0%, #e9ecef 100%);
      height: 6px;
      border-radius: 16px 16px 0 0;
      transition: background 0.3s ease;
      position: relative;
    }

    .progress-bar-wrapper::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      background: linear-gradient(90deg, #007bff, #0056b3);
      border-radius: 16px 0 0 0;
      transition: width 0.3s ease;
    }

    .form-card-body {
      padding: 40px;
      position: relative;
    }

    .step-header {
      display: flex;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #f0f0f0;
    }

    .step-header h4 {
      font-size: 20px;
      font-weight: 700;
      color: #212529;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .step-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      color: white;
      border-radius: 50%;
      font-weight: bold;
      font-size: 18px;
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
      flex-shrink: 0;
    }

    .step-content {
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-label {
      font-weight: 600;
      color: #495057;
      margin-bottom: 10px;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-control, .form-control-lg {
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      transition: all 0.3s ease;
      font-size: 15px;
    }

    .form-control:focus, .form-control-lg:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
      background-color: #f8f9fa;
    }

    .form-control::placeholder {
      color: #adb5bd;
      font-style: italic;
    }

    .button-group {
      display: flex;
      gap: 12px;
      margin-top: 35px;
      padding-top: 25px;
      border-top: 2px solid #f0f0f0;
      justify-content: flex-end;
    }

    .btn {
      padding: 12px 28px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 14px;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
      text-transform: uppercase;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }

    .btn-success:hover {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .btn-outline-secondary:hover {
      background: #6c757d;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(108, 117, 125, 0.3);
    }

    .btn-primary, .btn-success, .btn-outline-secondary {
      min-width: 140px;
      justify-content: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .form-card-body {
        padding: 25px;
      }

      .button-group {
        flex-direction: column;
        gap: 10px;
      }

      .btn {
        min-width: auto;
        width: 100%;
      }

      .slider-container {
        flex-direction: column;
        gap: 10px;
      }

      .slider-label {
        width: 100%;
        text-align: left;
      }
    }
  </style>

  <header class="site-navbar" role="banner">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-11 col-xl-4">
          <h1 class="mb-0 site-logo"><a href="index.html" class="text-white mb-0">SheCare<span
                class="text-primary">.</span> </a></h1>
        </div>
        <div class="col-12 col-md-8 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">

            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
              <li><a href="index.html"><span>Home</span></a></li>
              <li><a href="?hal=layanan_penyakit"><span>Layanan Penyakit</span></a></li>
              <li><a href="about.html"><span>About</span></a></li>
              <li><a href="blog.html"><span>Blog</span></a></li>
              <li><a href="?hal=login"><span>Login</span></a></li>
            </ul>
          </nav>
        </div>

        <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#"
            class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

      </div>

    </div>

  </header>

  <div class="site-blocks-cover overlay bg-light" style="background-image: url(assets/user/images/hero_bg_1.jpg);" data-aos="fade"
    data-stellar-background-ratio="0.5" style="position: relative; padding-top: 80px; padding-bottom: 80px;">
    <div class="container">
      <div class="row justify-content-center align-items-center text-center">
        <div class="col-md-12">
          <h1 class="mb-3 site-section-heading text-center font-secondary">Layanan Penyakit</h1>
          <p class="lead text-center">Periksa kesehatan Anda dengan menjawab beberapa pertanyaan dibawah ini</p>
        </div>
      </div>
    </div>
  </div>

  </div>

  <!-- Normal (non-floating) Card Form inserted here -->
  <div style="width:90%; max-width:900px; margin: 20px auto 0;">
    <div class="floating-form-card">
      <div class="progress-bar-wrapper" id="progress_bar"></div>

      <!-- Judul Penyakit di Atas Card -->
      <div style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 25px; text-align: center; border-radius: 16px 16px 0 0;">
        <h2 class="mb-0" id="judul_penyakit" style="font-size: 24px; font-weight: 700; letter-spacing: 0.5px;">Pemeriksaan Penyakit</h2>
      </div>

      <!-- Form -->
      <form id="form_pemeriksaan" class="form-card-body" novalidate>
        <input type="hidden" id="id_penyakit" name="id_penyakit">
        <input type="hidden" id="current_step" value="1">

        <!-- Step 1: Data Diri -->
        <div id="step_1" class="step-content" style="display: block;">
          <div class="step-header">
            <span class="step-badge">1</span>
            <h4>Data Diri Anda</h4>
          </div>
          
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
          </div>

          <div class="mb-3">
            <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
            <input type="number" class="form-control form-control-lg" id="umur" name="umur" min="1" max="120" placeholder="Contoh: 25" required>
          </div>

          <div class="mb-4">
            <label for="no_telp" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
            <input type="tel" class="form-control form-control-lg" id="no_telp" name="no_telp" pattern="[0-9]{10,}" placeholder="Contoh: 08123456789" required>
          </div>
        </div>

        <!-- Step 2: Pertanyaan -->
        <div id="step_2" class="step-content" style="display: none;">
          <div class="step-header">
            <span class="step-badge">2</span>
            <h4>Pertanyaan Pemeriksaan</h4>
          </div>
          <div id="daftar_pertanyaan">
            <!-- Pertanyaan akan dimuat di sini -->
          </div>
            <div id="after_pertanyaan_fitur" style="margin-top:20px;"></div>
        </div>

        <!-- Navigation Buttons -->
        <div class="button-group">
          <button type="button" id="btn_prev" class="btn btn-outline-secondary" onclick="previousStep()" style="display: none;">← Kembali</button>
          <button type="button" id="btn_next" class="btn btn-primary" onclick="nextStep()">Lanjut →</button>
          <button type="submit" id="btn_submit" class="btn btn-success" onclick="submitPemeriksaan(event)" style="display: none;">✓ Kirim</button>
        </div>
      </form>

    </div>
  </div>

  <div class="site-section py-5" style="margin-top: 80px;"></div>

  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
              <h2 class="footer-heading mb-4">Quick Links</h2>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
              <h2 class="footer-heading mb-4">Products</h2>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
              <h2 class="footer-heading mb-4">Features</h2>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
              <h2 class="footer-heading mb-4">Follow Us</h2>
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
            blind
            texts.</p>
          <form action="#" method="post" class="subscription">
            <div class="input-group mb-3  d-flex align-items-stretch">
              <input type="text" class="form-control bg-transparent" placeholder="Enter Email" aria-label="Enter Email"
                aria-describedby="button-addon2">
              <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
            </div>
          </form>
        </div>
      </div>
      <div class="row pt-5 mt-5">
        <div class="col-12 text-md-center text-left">
          <p>
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> All rights reserved | SheCare
          </p>
        </div>
      </div>
    </div>
  </footer>
</div>

<script>
  let totalSteps = 3;
  let currentStep = 1;
  let totalQuestions = 0;
  let fiturDefinitions = []; // store fitur_prediksi definitions for step 3

  $(document).ready(function() {
    // Initialize progress bar
    const progressBar = $('#progress_bar');
    if(progressBar.length) {
      progressBar.css('background', 'linear-gradient(to right, #007bff 0%, #007bff 0%, #e9ecef 0%, #e9ecef 100%)');
      progressBar.css('transition', 'background 0.3s ease');
    }

    // Get id_penyakit from URL
    const urlParams = new URLSearchParams(window.location.search);
    const idPenyakit = urlParams.get('id');
    
    if(!idPenyakit) {
      Swal.fire('Error', 'ID penyakit tidak ditemukan', 'error');
      window.location.href = '?hal=layanan_penyakit';
      return;
    }

    $('#id_penyakit').val(idPenyakit);

    // Load disease info and questions
    loadPenyakitAndPertanyaan(idPenyakit);
    // We'll load prediction features after questions load; keep a promise handle
    let loadFiturPromise = null;

    // If debug flag present, auto-fill sample inputs and run ONNX for testing
    const debugFlag = urlParams.get('debug_onnx') === '1';
    if (debugFlag) {
      loadFiturPromise.then(() => {
        try {
          // Fill sample values for each feature
          fiturDefinitions.forEach(f => {
            const key = f.nama_fitur || f.nama || ('fitur_' + f.id_fitur);
            const tipe = (f.tipe_input || f.tipe || 'text').toLowerCase();
            if (tipe === 'number') {
              const min = parseFloat(f.nilai_min) || 0;
              const max = parseFloat(f.nilai_max) || (min + 1);
              const mid = ((min + max) / 2) || 0;
              $(`#fitur_${key}`).val(mid);
            } else if (tipe === 'select') {
              $(`#fitur_${key}`).prop('selectedIndex', 0);
            } else if (tipe === 'radio') {
              $(`input[name=fitur_${key}_radio]:first`).prop('checked', true);
            } else if (tipe === 'checkbox') {
              $(`[id^=fitur_${key}_check_]:first`).prop('checked', true);
            } else {
              $(`#fitur_${key}`).val('0');
            }
          });

          console.log('DEBUG: sample inputs filled, running ONNX predict...');
          runOnnxPredict().then(() => {
            console.log('DEBUG: onnx result ->', window.__prediksi_result);
          }).catch(e => console.error('DEBUG: onnx run error', e));
        } catch (err) {
          console.error('DEBUG harness error', err);
        }
      });
    }

    // Form submission
    $('#form_pemeriksaan').on('submit', function(e) {
      e.preventDefault();
      submitPemeriksaan(e);
    });

    // Initialize buttons on load
    updateStep();

    // Update displayed slider value and color on input
    $(document).on('input', '.pertanyaan-range', function() {
      const value = $(this).val();
      const id = $(this).attr('id');
      const valueSpan = $('#' + id.replace('_range', '_value'));
      const descSpan = $('#' + id.replace('_range', '_desc'));
      
      // Update value text
      valueSpan.text(value);
      
      // Update color class based on value
      valueSpan.removeClass('value-1 value-2 value-3 value-4 value-5');
      valueSpan.addClass('value-' + value);
      
      // Update description
      const descriptions = {
        '1': 'Tidak Pernah',
        '2': 'Jarang',
        '3': 'Kadang-kadang',
        '4': 'Sering',
        '5': 'Sangat Sering'
      };
      descSpan.text(descriptions[value]);
    });
  });

  function loadPenyakitAndPertanyaan(idPenyakit) {
    // Load penyakit info
    $.ajax({
      url: 'crud/show_data_penyakit.php',
      method: 'GET',
      data: { id: idPenyakit },
      dataType: 'json',
      success: function(response) {
        if(response.status) {
          $('#judul_penyakit').text("Pemeriksaan " + response.data.nama_penyakit);
        }
      },
      error: function() {
        console.error('Error loading penyakit');
      }
    });

    // Load pertanyaan
    $.ajax({
      url: 'crud/index_data_pertanyaan.php',
      method: 'GET',
      data: { id_penyakit: idPenyakit },
      dataType: 'json',
      success: function(response) {
        if(response.status && response.data.length > 0) {
          totalQuestions = response.data.length;
          let pertanyaanHTML = '';
          response.data.forEach(function(pertanyaan, index) {
            const pertanyaanId = 'pertanyaan_' + pertanyaan.id_pertanyaan;
            const labelDescriptions = {
              '1': 'Tidak Pernah',
              '2': 'Jarang',
              '3': 'Kadang-kadang',
              '4': 'Sering',
              '5': 'Sangat Sering'
            };
            
            pertanyaanHTML += `
              <div class="question-item">
                <div class="question-title">
                  <span class="question-number">${index + 1}</span>
                  ${pertanyaan.judul_pertanyaan}
                </div>
                <div class="slider-container">
                  <span class="slider-label start">Tidak Pernah</span>
                  <div class="slider-wrapper">
                    <input type="range" class="pertanyaan-range" name="${pertanyaanId}" id="${pertanyaanId}_range" min="1" max="5" step="1" value="1" data-output="#${pertanyaanId}_value">
                    <span id="${pertanyaanId}_value" class="slider-value value-1">1</span>
                  </div>
                  <span class="slider-label end">Sangat Sering</span>
                </div>
                <div class="slider-description">
                  <span id="${pertanyaanId}_desc">Tidak Pernah</span>
                </div>
              </div>
            `;
          });
          $('#daftar_pertanyaan').html(pertanyaanHTML);
          // Render fitur_prediksi right after the general questions (inline)
          // This will show feature inputs immediately under the questions
          loadFiturPromise = loadFiturPrediksi(idPenyakit, '#after_pertanyaan_fitur');
        } else {
          $('#daftar_pertanyaan').html('<p class="text-muted">Tidak ada pertanyaan untuk penyakit ini</p>');
        }
      },
      error: function() {
        console.error('Error loading pertanyaan');
        $('#daftar_pertanyaan').html('<p class="text-danger">Gagal memuat pertanyaan</p>');
      }
    });
  }

  function nextStep() {
    // Validate current step
    if(currentStep === 1) {
      // Validate data diri
      if(!$('#nama').val() || !$('#umur').val() || !$('#no_telp').val()) {
        Swal.fire('Peringatan', 'Silakan isi semua data diri', 'warning');
        return;
      }
    }

    if(currentStep < totalSteps) {
      currentStep++;
      updateStep();
    }
  }

  function previousStep() {
    if(currentStep > 1) {
      currentStep--;
      updateStep();
    }
  }

  function updateStep() {
    // Hide all steps
    $('.step-content').hide();
    
    // Show current step
    $('#step_' + currentStep).show();

    // Update buttons
    if(currentStep === 1) {
      $('#btn_prev').hide();
      $('#btn_next').show();
      $('#btn_submit').hide();
    } else if(currentStep === totalSteps) {
      $('#btn_prev').show();
      $('#btn_next').hide();
      $('#btn_submit').show();
    } else {
      $('#btn_prev').show();
      $('#btn_next').show();
      $('#btn_submit').hide();
    }

    // Update progress bar
    const progressBar = $('#progress_bar');
    const progress = (currentStep / totalSteps) * 100;
    if(progressBar.length) {
      progressBar.css('background', `linear-gradient(to right, #007bff 0%, #007bff ${progress}%, #e9ecef ${progress}%, #e9ecef 100%)`);
    }

    // Scroll to form
    const floatingCard = $('.floating-form-card');
    if(floatingCard.length) {
      $('html, body').animate({
        scrollTop: floatingCard.offset().top - 100
      }, 300);
    }
  }

  function submitPemeriksaan(e) {
    if(e) e.preventDefault();

    const nama = $('#nama').val();
    const umur = $('#umur').val();
    const no_telp = $('#no_telp').val();
    const id_penyakit = $('#id_penyakit').val();

    // Collect answers from sliders
    const jawaban = {};
    $('.pertanyaan-range').each(function() {
      const name = $(this).attr('name');
      jawaban[name] = $(this).val();
    });

    // keep jawaban in window so Step 3 can prefill fitur inputs
    window.__jawaban = jawaban;

    console.log(jawaban);

    // Validate all questions answered (each slider has a value)
    if(Object.keys(jawaban).length !== totalQuestions) {
      Swal.fire('Peringatan', 'Silakan jawab semua pertanyaan', 'warning');
      return;
    }

    // Show loading
    Swal.fire({
      title: 'Memproses...',
      html: 'Menyimpan pemeriksaan dan menjalankan prediksi...',
      icon: 'info',
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => { Swal.showLoading(); }
    });

    // Submit to server
    $.ajax({
      url: 'crud/store_pemeriksaan.php',
      method: 'POST',
      data: {
        nama: nama,
        umur: umur,
        no_telp: no_telp,
        id_penyakit: id_penyakit,
        jawaban: JSON.stringify(jawaban)
      },
      dataType: 'json',
      success: function(response) {
        if(response.status) {
          // Save returned id_pemeriksaan - it's directly in response, not response.data
          const idPemeriksaan = response.id_pemeriksaan || null;
          window.__id_pemeriksaan = idPemeriksaan;
          console.log('ID Pemeriksaan saved:', idPemeriksaan);
          
          // Load fitur and run ONNX prediction
          loadFiturPrediksi(id_penyakit, '#daftar_fitur_prediksi').then(() => {
            // After fitur loaded, run ONNX and auto-submit
            runOnnxPredictAuto();
          }).catch(() => {
            Swal.fire('Gagal', 'Gagal memuat fitur prediksi', 'error');
          });
        } else {
          Swal.fire('Gagal', response.message || 'Gagal menyimpan pemeriksaan', 'error');
        }
      },
      error: function() {
        Swal.fire('Gagal', 'Terjadi kesalahan pada server', 'error');
      }
    });
  }

  /* Step 3: Load fitur_prediksi, render inputs, run ONNX, submit prediction */
  async function loadFiturPrediksi(idPenyakit, targetSelector = '#daftar_fitur_prediksi') {
    $(targetSelector).html('<p class="text-muted">Memuat fitur prediksi...</p>');
    try {
      const resp = await $.ajax({
        url: 'crud/index_fitur_prediksi.php',
        method: 'GET',
        data: { id_penyakit: idPenyakit },
        dataType: 'json'
      });

      if(!resp.status) {
        $('#daftar_fitur_prediksi').html('<p class="text-danger">Gagal memuat fitur prediksi</p>');
        return;
      }

      fiturDefinitions = resp.data || [];
      // Sort by urutan to match model input mapping
      fiturDefinitions.sort((a,b) => (Number(a.urutan) || 0) - (Number(b.urutan) || 0));

      if(fiturDefinitions.length === 0) {
        $('#daftar_fitur_prediksi').html('<p class="text-muted">Tidak ada fitur prediksi untuk penyakit ini</p>');
        return;
      }

      let html = '';
      html += '<div class="mb-3"><p class="text-muted">Prediksi akan berjalan otomatis setelah Anda klik tombol Kirim.</p></div>';

      fiturDefinitions.forEach((f, idx) => {
        html += renderFiturInput(f, idx+1);
      });

      $(targetSelector).html(html);

      // After rendering, attempt to prefill fitur inputs from prior jawaban
      try {
        prefillFiturFromJawaban();
      } catch (e) {
        console.warn('Prefill error', e);
      }
    } catch(err) {
      console.error(err);
      $(targetSelector).html('<p class="text-danger">Terjadi kesalahan saat memuat fitur prediksi</p>');
    }
  }

  function prefillFiturFromJawaban() {
    if(!window.__jawaban) return;

    // Build ordered array of answers from the question sliders (DOM order)
    const questionVals = [];
    $('.pertanyaan-range').each(function() {
      const name = $(this).attr('name');
      questionVals.push({ name: name, value: window.__jawaban[name] });
    });

    // If number of features equals number of questions, map by position
    if(fiturDefinitions && questionVals.length > 0 && fiturDefinitions.length === questionVals.length) {
      fiturDefinitions.forEach((f, idx) => {
        const key = f.nama_fitur || f.nama || ('fitur_' + f.id_fitur);
        const val = questionVals[idx] ? questionVals[idx].value : null;
        if(val !== null && val !== undefined) {
          const el = $(`#fitur_${key}`);
          if(el.length) el.val(val);
          // handle radio/checkbox separately
          $(`input[name=fitur_${key}_radio][value="${val}"]`).prop('checked', true);
          $(`[id^=fitur_${key}_check_]`).each(function() {
            // check those with matching value
            if(String($(this).val()) === String(val)) $(this).prop('checked', true);
          });
        }
      });
      return;
    }

    // Otherwise try matching by exact key name
    fiturDefinitions.forEach((f) => {
      const key = f.nama_fitur || f.nama || ('fitur_' + f.id_fitur);
      if(window.__jawaban.hasOwnProperty(key)) {
        const val = window.__jawaban[key];
        const el = $(`#fitur_${key}`);
        if(el.length) el.val(val);
        $(`input[name=fitur_${key}_radio][value="${val}"]`).prop('checked', true);
        $(`[id^=fitur_${key}_check_]`).each(function() {
          if(String($(this).val()) === String(val)) $(this).prop('checked', true);
        });
      }
    });
  }

  function renderFiturInput(fitur, number) {
    // Determine choices
    let choices = null;
    try {
      if(fitur.pilihan_json) {
        choices = JSON.parse(fitur.pilihan_json);
      }
    } catch(e) {
      choices = null;
    }
    if(!choices && fitur.pilihan) {
      choices = String(fitur.pilihan).split(',').map(s => s.trim()).filter(Boolean);
    }

    const nameKey = fitur.nama_fitur || fitur.nama || ('fitur_' + fitur.id_fitur);
    const label = fitur.label_fitur || fitur.label || nameKey;
    const tipe = (fitur.tipe_input || fitur.tipe || 'text').toLowerCase();
    const min = fitur.nilai_min || fitur.min || '';
    const max = fitur.nilai_max || fitur.max || '';
    const step = fitur.step_value || fitur.step || '1';

    let html = '';
    html += `<div class="question-item">`;
    html += `<div class="question-title"><span class="question-number">${number}</span> ${label}</div>`;

    if(tipe === 'number') {
      html += `
        <div class="mb-2">
          <input type="number" class="form-control" id="fitur_${nameKey}" data-nama="${nameKey}" data-tipe="number" value="${min || ''}" ${min!==''?`min="${min}"`:''} ${max!==''?`max="${max}"`:''} step="${step}">
        </div>
      `;
    } else if(tipe === 'select') {
      html += `<select class="form-control" id="fitur_${nameKey}" data-nama="${nameKey}" data-tipe="select">`;
      if(choices && choices.length) {
        choices.forEach((c, i) => {
          html += `<option value="${i}">${c}</option>`;
        });
      }
      html += `</select>`;
    } else if(tipe === 'radio') {
      if(choices && choices.length) {
        html += `<div>`;
        choices.forEach((c,i) => {
          html += `<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="fitur_${nameKey}_radio" id="fitur_${nameKey}_radio_${i}" value="${i}" ${i===0? 'checked' : ''}><label class="form-check-label" for="fitur_${nameKey}_radio_${i}">${c}</label></div>`;
        });
        html += `</div>`;
      }
    } else if(tipe === 'checkbox') {
      if(choices && choices.length) {
        html += `<div>`;
        choices.forEach((c,i) => {
          html += `<div class="form-check"><input class="form-check-input" type="checkbox" id="fitur_${nameKey}_check_${i}" value="${i}"><label class="form-check-label" for="fitur_${nameKey}_check_${i}">${c}</label></div>`;
        });
        html += `</div>`;
      }
    } else if(tipe === 'textarea') {
      html += `<textarea class="form-control" id="fitur_${nameKey}" data-nama="${nameKey}" data-tipe="textarea"></textarea>`;
    } else {
      // default text
      html += `<input type="text" class="form-control" id="fitur_${nameKey}" data-nama="${nameKey}" data-tipe="text">`;
    }

    if(fitur.deskripsi) {
      html += `<div class="slider-description">${fitur.deskripsi}</div>`;
    }

    html += `</div>`;
    return html;
  }

  async function loadOrtScript() {
    if(window.ort) return; // already loaded
    return new Promise((resolve, reject) => {
      const s = document.createElement('script');
      s.src = 'https://cdn.jsdelivr.net/npm/onnxruntime-web/dist/ort.min.js';
      s.onload = () => resolve();
      s.onerror = (e) => reject(e);
      document.head.appendChild(s);
    });
  }

  async function runOnnxPredictAuto() {
    // Automatically run ONNX prediction after form submit
    // This will be called internally, not by user button click
    await runOnnxPredict();
  }

  async function runOnnxPredict() {
    // Collect nilai_fitur according to urutan
    if(!fiturDefinitions || fiturDefinitions.length === 0) {
      Swal.fire('Info', 'Tidak ada fitur untuk diprediksi', 'info');
      return;
    }

    // Update loading message
    Swal.update({
      title: 'Memproses...',
      html: 'Menjalankan prediksi model...',
      didOpen: () => { Swal.showLoading(); }
    });

    const nilai_fitur = {};
    const inputVector = [];

    // Collect values and map categorical options to their index
    for(const f of fiturDefinitions) {
      const key = f.nama_fitur || f.nama || ('fitur_' + f.id_fitur);
      const tipe = (f.tipe_input || f.tipe || 'text').toLowerCase();
      let value = null;

      if(tipe === 'number') {
        value = parseFloat($(`#fitur_${key}`).val());
        if(isNaN(value)) value = 0;
      } else if(tipe === 'select') {
        value = parseFloat($(`#fitur_${key}`).val());
        if(isNaN(value)) value = 0;
      } else if(tipe === 'radio') {
        const v = $(`input[name=fitur_${key}_radio]:checked`).val();
        value = v !== undefined ? parseFloat(v) : 0;
      } else if(tipe === 'checkbox') {
        // sum indices of checked boxes as a simple encoding
        let sum = 0;
        $(`[id^=fitur_${key}_check_]`).each(function() {
          if($(this).is(':checked')) sum += parseFloat($(this).val()) || 0;
        });
        value = sum;
      } else if(tipe === 'textarea' || tipe === 'text') {
        const v = $(`#fitur_${key}`).val();
        const num = parseFloat(v);
        value = isNaN(num) ? 0 : num;
      } else {
        const v = $(`#fitur_${key}`).val();
        const num = parseFloat(v);
        value = isNaN(num) ? 0 : num;
      }

      nilai_fitur[key] = value;
      inputVector.push(Number(value));
    }

    $('#prediksi_status').text('Menjalankan model...');
    try {
      await loadOrtScript();
      // fetch model
      const modelResp = await fetch('python/decision_tree.onnx');
      const modelArrayBuffer = await modelResp.arrayBuffer();

      const session = await ort.InferenceSession.create(modelArrayBuffer);
      console.log(session.outputNames);

      // determine input name and shape
      let inputName = null;
      if(session.inputNames && session.inputNames.length) {
        inputName = session.inputNames[0];
      } else if(session.inputMetadata) {
        inputName = Object.keys(session.inputMetadata)[0];
      } else {
        // fallback common name
        inputName = 'input';
      }

      // Prepare tensor: float32 2D [1, N]
      // Inspect expected input shape from model metadata (if available) and pad/truncate accordingly
      let expectedDim = null;
      try {
        const meta = session.inputMetadata && session.inputMetadata[inputName];
        if (meta && Array.isArray(meta.dimensions)) {
          // find the first dynamic/static dimension > 1 (skip batch dim if present)
          const dims = meta.dimensions;
          // often meta.dimensions might be [1, N] or [N]
          if (dims.length === 2) {
            expectedDim = Math.max(1, Number(dims[1]));
          } else if (dims.length === 1) {
            expectedDim = Math.max(1, Number(dims[0]));
          }
        }
      } catch (e) {
        console.warn('Unable to read input metadata:', e);
      }

      let floatArray = Float32Array.from(inputVector);
      if (expectedDim !== null && !isNaN(expectedDim)) {
        if (floatArray.length < expectedDim) {
          console.warn(`Model expects ${expectedDim} features but got ${floatArray.length}. Padding with zeros.`);
          const padded = new Float32Array(expectedDim);
          padded.set(floatArray, 0);
          floatArray = padded;
        } else if (floatArray.length > expectedDim) {
          console.warn(`Model expects ${expectedDim} features but got ${floatArray.length}. Truncating to expected size.`);
          floatArray = floatArray.slice(0, expectedDim);
        }
      }

      const tensor = new ort.Tensor('float32', floatArray, [1, floatArray.length]);

      const feeds = {};
      feeds[inputName] = tensor;

      console.log("InputNames:", session.inputNames);
      console.log("OutputNames:", session.outputNames);
      console.log("Input data:", tensor);

      const results = await session.run(feeds);

      // get outputs robustly (some outputs may be non-tensor typed)
      const outKeys = Object.keys(results || {});
      let skor = null;
      let label = null;
      if (outKeys.length) {
        for (let i = 0; i < outKeys.length; i++) {
          const key = outKeys[i];
          try {
            const outVal = results[key];
            // robust access to various output types (TypedArray, Tensor-like, Map, scalar, object, array)
            if (outVal === undefined || outVal === null) {
              // nothing
            } else if (typeof outVal === 'number' || typeof outVal === 'string' || typeof outVal === 'boolean') {
              const v = outVal;
              if (skor === null) skor = v;
              else if (label === null) label = v;
            } else if (ArrayBuffer.isView(outVal)) {
              // outVal is a TypedArray (e.g., Float32Array)
              const v = outVal[0];
              if (skor === null) skor = v;
              else if (label === null) label = v;
            } else if (outVal && outVal.data && ArrayBuffer.isView(outVal.data)) {
              // tensor-like with `.data` as TypedArray
              const v = outVal.data[0];
              if (skor === null) skor = v;
              else if (label === null) label = v;
            } else if (Array.isArray(outVal)) {
              const v = outVal[0];
              if (skor === null) skor = v;
              else if (label === null) label = v;
            } else if (outVal instanceof Map) {
              const obj = Object.fromEntries(outVal);
              console.log("Non-tensor output (map):", obj);
              const vals = Object.values(obj);
              if (vals.length) {
                const v = vals[0];
                if (skor === null) skor = v;
                else if (label === null) label = v;
              }
            } else if (typeof outVal === 'object') {
              // try to extract a primitive or first numeric/typed-array value from object
              const vals = Object.values(outVal);
              let found = false;
              for (const vv of vals) {
                if (typeof vv === 'number' || typeof vv === 'string' || typeof vv === 'boolean') {
                  if (skor === null) skor = vv;
                  else if (label === null) label = vv;
                  found = true;
                  break;
                } else if (ArrayBuffer.isView(vv)) {
                  const v = vv[0];
                  if (skor === null) skor = v;
                  else if (label === null) label = v;
                  found = true;
                  break;
                } else if (vv && vv.data && ArrayBuffer.isView(vv.data)) {
                  const v = vv.data[0];
                  if (skor === null) skor = v;
                  else if (label === null) label = v;
                  found = true;
                  break;
                }
              }
              if (!found) {
                console.log("Non-tensor output (object):", outVal);
                if (label === null) {
                  try { label = JSON.stringify(outVal); } catch (er) { label = String(outVal); }
                }
              }
            } else {
              // unknown type, stringify for safety
              console.log("Non-tensor output (unknown):", outVal);
              if (label === null) {
                try { label = JSON.stringify(outVal); } catch (er) { label = String(outVal); }
              }
            }
          } catch (e) {
            // Accessing .data may throw for non-tensor outputs; capture fallback
            console.warn('Non-tensor output for', key, e);
            if (label === null) {
              try { label = JSON.stringify(results[key]); } catch (er) { label = String(results[key]); }
            }
          }
        }
      }

      // If the model returned a numeric class index (e.g. 0/1), map to readable label
      try {
        if (label !== null) {
          const maybeNum = Number(label);
          if (!isNaN(maybeNum)) {
            if (maybeNum === 0) label = 'Negatif';
            else if (maybeNum === 1) label = 'Positif';
            else label = String(label);
          }
        }
      } catch (e) {
        // ignore mapping errors
      }

      // store result in window so user can submit
      window.__prediksi_result = {
        skor_prediksi: skor,
        hasil_prediksi: label,
        nilai_fitur: nilai_fitur
      };

      // Auto-submit hasil prediksi ke server
      submitPrediksiAuto();
    } catch(err) {
      console.error('ONNX error', err);
      Swal.fire('Gagal', 'Gagal menjalankan model prediksi: ' + err.message, 'error');
      // still allow submission with nilai_fitur only
      window.__prediksi_result = { skor_prediksi: null, hasil_prediksi: null, nilai_fitur };
    }
  }

  function submitPrediksiAuto() {
    const idPemeriksaan = window.__id_pemeriksaan || null;
    const idPenyakit = $('#id_penyakit').val();
    const modelVersion = 'client-onnx';

    if(!idPemeriksaan) {
      Swal.fire('Error', 'ID pemeriksaan tidak ditemukan. Silakan ulangi langkah sebelumnya.', 'error');
      return;
    }

    // Helper function to handle BigInt serialization
    const cleanData = (data) => {
      if (typeof data === 'bigint') {
        return Number(data);
      }
      if (Array.isArray(data)) {
        return data.map(cleanData);
      }
      if (data !== null && typeof data === 'object') {
        const cleaned = {};
        for (const key in data) {
          cleaned[key] = cleanData(data[key]);
        }
        return cleaned;
      }
      return data;
    };

    const payload = {
      id_pemeriksaan: idPemeriksaan,
      id_penyakit: idPenyakit,
      nilai_fitur: window.__prediksi_result && window.__prediksi_result.nilai_fitur ? window.__prediksi_result.nilai_fitur : {},
      skor_prediksi: window.__prediksi_result ? window.__prediksi_result.skor_prediksi : null,
      hasil_prediksi: window.__prediksi_result ? window.__prediksi_result.hasil_prediksi : null,
      deskripsi_hasil: null,
      rekomendasi: null,
      model_version: modelVersion
    };

    // Clean payload to handle BigInt
    const cleanPayload = cleanData(payload);

    $.ajax({
      url: 'crud/store_prediksi.php',
      method: 'POST',
      data: JSON.stringify(cleanPayload),
      contentType: 'application/json; charset=utf-8',
      dataType: 'json',
      success: function(resp) {
        if(resp.status) {
          // Display prediction result with SweetAlert
          const hasilText = window.__prediksi_result.hasil_prediksi || 'Tidak Terdefinisi';
          let skorText = '-';
          
          // Safely convert skor_prediksi to string
          if (window.__prediksi_result.skor_prediksi !== null && window.__prediksi_result.skor_prediksi !== undefined) {
            const skorNum = Number(window.__prediksi_result.skor_prediksi);
            if (!isNaN(skorNum)) {
              skorText = skorNum.toFixed(4);
            } else {
              skorText = String(window.__prediksi_result.skor_prediksi);
            }
          }
          
          Swal.fire({
            title: '✓ Prediksi Berhasil',
            html: `
              <div style="text-align: left; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <p style="margin-bottom: 10px;"><strong>Hasil Prediksi:</strong> <span style="color: #007bff; font-size: 18px; font-weight: bold;">${hasilText}</span></p>
                <p style="margin-bottom: 0;"><strong>Skor Prediksi:</strong> <span style="color: #28a745; font-size: 16px; font-weight: bold;">${skorText}</span></p>
              </div>
            `,
            icon: 'success',
            confirmButtonText: 'Kembali ke Layanan',
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then(() => {
            // redirect to hasil atau layanan
            window.location.href = '?hal=layanan_penyakit';
          });
        } else {
          Swal.fire('Gagal', resp.message || 'Gagal menyimpan hasil prediksi', 'error');
        }
      },
      error: function() {
        Swal.fire('Gagal', 'Terjadi kesalahan saat mengirim hasil prediksi', 'error');
      }
    });
  }
</script>