<div class="nav-align-top mb-4">
  <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#profil" aria-controls="navs-pills-justified-home" aria-selected="true">
        <i class="tf-icons bx bx-home"></i>
        Profil
        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger" >3</span>
      </button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#password" aria-controls="navs-pills-justified-profile" aria-selected="false">
        <i class="tf-icons bx bx-user"></i>
        Profile
      </button>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="profil" role="tabpanel">

    </div>
    <div class="tab-pane fade" id="password" role="tabpanel">
      
    </div>
  </div>
</div>

<div class="card mb-4">
  <h5 class="card-header">Profile Details</h5>
  <!-- Account -->
  <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
      <img
        src="../../assets/img/avatars/1.png"
        alt="user-avatar"
        class="d-block rounded"
        height="100"
        width="100"
        id="uploadedAvatar"
      />
      <div class="button-wrapper">
        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
          <span class="d-none d-sm-block">Upload new photo</span>
          <i class="bx bx-upload d-block d-sm-none"></i>
          <input
            type="file"
            id="upload"
            class="account-file-input"
            hidden=""
            accept="image/png, image/jpeg"
          />
        </label>
        <button
          type="button"
          class="btn btn-label-secondary account-image-reset mb-4"
        >
          <i class="bx bx-reset d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Reset</span>
        </button>

        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
      </div>
    </div>
  </div>
  <hr class="my-0" />
  <div class="card-body">
    <form id="formAccountSettings" method="POST" action="/user/perbarui" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
      <div class="row">
        <div class="mb-3 col-md-6 fv-plugins-icon-container">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input class="form-control" type="text" id="nama" name="nama" value="<?= $model['user']['nama'] ?? "" ?>">
          <div
            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
          ></div>
        </div>
        <div class="mb-3 col-md-6 fv-plugins-icon-container">
          <label for="username" class="form-label">Username</label>
          <input class="form-control" type="text" name="username" id="username"
          value="<?= $model['user']['username'] ?? "" ?>">
          <div
            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
          ></div>
        </div>
      </div>
      <div class="mt-2">
        <button type="submit" class="btn btn-primary me-2">Simpan</button>
        <button type="reset" class="btn btn-secondary">Batal</button>
      </div>
    </form>
  </div>
  <!-- /Account -->
</div>
