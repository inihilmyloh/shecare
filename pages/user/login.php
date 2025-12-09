<main class="main-content  mt-0">
  <section>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang Kembali!</h3>
                <p class="mb-0">Masukkan email dan password anda untuk login</p>
              </div>
              <div class="card-body">
                <form role="form">
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                  </div>
                  <div class="text-center">
                    <button type="button" onclick="login()" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Tidak punya akun?
                  <a href="" class="text-info text-gradient font-weight-bold">Daftar disini</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/admin/img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
  function login() {
    let xhttp = new XMLHttpRequest();
    let formData = new FormData();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    formData.append('email', email);
    formData.append('password', password);

    xhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        Swal.fire({
          title: data.title,
          text: data.message,
          icon: data.status,
        }).then((result) => {
          if(data.status == 'success') {
            window.location.href = window.location.href.replace('hal=login', 'hal=dashboard');
          }
        });
      }
    };

    xhttp.open('POST', 'crud/login.php', true);
    xhttp.send(formData);
  }
</script>