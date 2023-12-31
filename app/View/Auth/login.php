<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  
        <?php if(isset($model['error'])) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <?= $model['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"button>
            </div>
        <?php } ?>

      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 mb-3"><?= $model['heading'] ?? '' ?></h1>
          <p class="col-lg-10 fs-4">
            by
            <a target="_blank" href="https://www.instagram.com/irfan.em">
                Programmer Anyaran
            </a>
          </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form
            class="p-4 p-md-5 border rounded-3 bg-light"
            method="post"
            action="/auth/login"
          >
            <div class="form-floating mb-3">
              <input
                name="username"
                type="text"
                class="form-control"
                id="username"
                placeholder="Email"
                value="<?= $_POST['username'] ?? '' ?>"
              />
              <label for="username">Email</label>
            </div>
            <div class="form-floating mb-3">
              <input
                name="password"
                type="password"
                class="form-control"
                id="password"
                placeholder="password"
              />
              <label for="password">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">
              Sign On
            </button>

            <p class="text-center">
                <span>Ora due akun ? </span>
                <a href="/auth/daftar">
                  <span>Daftar nang kene</span>
                </a>
            </p>

          </form>
        </div>
      </div>
    </div>