<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

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
              <li class="active"><a href="index.html"><span>Home</span></a></li>
              <li class="has-children">
                <a href="services.html"><span>Services</span></a>
                <ul class="dropdown arrow-top">
                  <li><a href="#">Physical Therapy</a></li>
                  <li><a href="#">Massage Therapy</a></li>
                  <li><a href="#">Chiropractic Therapy</a></li>
                  <li class="has-children">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown">
                      <li><a href="#">Physical Therapy</a></li>
                      <li><a href="#">Massage Therapy</a></li>
                      <li><a href="#">Chiropractic Therapy</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="about.html"><span>About</span></a></li>
              <li><a href="blog.html"><span>Blog</span></a></li>
              <li><a href="contact.html"><span>Contact</span></a></li>
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
    data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row justify-content-center align-items-center text-center">
        <div class="col-md-12">
          <h1 class="mb-3 site-section-heading text-center font-secondary">Layanan Penyakit</h1>
          <p class="lead text-center">Periksa kesehatan Anda dengan menjawab beberapa pertanyaan</p>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section py-5">
    <div class="container">
      <div class="row" id="daftar_penyakit">
        <!-- Daftar penyakit akan dimuat di sini -->
      </div>
    </div>
  </div>

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
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with
            <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com"
              target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
      </div>
    </div>
  </footer>
</div>

<script>
  $(document).ready(function() {
    // Load daftar penyakit
    $.ajax({
      url: 'crud/index_data_penyakit.php',
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        let penyakitHTML = '';
        if(response.data && response.data.length > 0) {
          response.data.forEach(function(penyakit) {
            penyakitHTML += `
              <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                  <div class="card-img-top" style="height: 250px; overflow: hidden;">
                    <img src="data:image/jpeg;base64,${penyakit.thumbnail}" alt="${penyakit.nama_penyakit}" class="img-fluid" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title">${penyakit.nama_penyakit}</h5>
                    <p class="card-text flex-grow-1">${penyakit.deskripsi_penyakit.substring(0, 100)}...</p>
                    <a href="?hal=detail_layanan_penyakit&id=${penyakit.id_penyakit}" class="btn btn-primary btn-sm mt-auto">Periksa</a>
                  </div>
                </div>
              </div>
            `;
          });
        } else {
          penyakitHTML = '<p class="col-md-12 text-center text-muted">Tidak ada data penyakit</p>';
        }
        $('#daftar_penyakit').html(penyakitHTML);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
        $('#daftar_penyakit').html('<p class="col-md-12 text-center text-danger">Gagal memuat data penyakit</p>');
      }
    });
  });
</script>