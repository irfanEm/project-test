<div class="container-xxl flex-grow-1 container-p-y">

    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <?= $model['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"button>
        </div>
    <?php } ?>

    <div class="row fv-plugins-icon-container">
        <div class="col-md-12">

            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#profil" aria-controls="navs-pills-justified-home" aria-selected="true">
                            <i class="tf-icons bx bx-user me-1"></i>
                            Profil
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#password" aria-controls="navs-pills-justified-profile" aria-selected="false">
                            <i class="bx bx-lock-alt me-1"></i>
                            Sandi
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profil" role="tabpanel">

                        <h5 class="mb-4 mb-xs-4">Profile Details</h5>

                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="/bootstrap/sneat/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="profil" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="profil" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </div>
                        </div>

                        <hr class="my-4" />

                        <form id="formAccountSettings" method="POST" action="/user/perbarui" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                            <div class="row">
                                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="nama" name="nama" value="<?= $model['user']['nama'] ?? "" ?>">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" id="username" value="<?= $model['user']['username'] ?? "" ?>">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                            </div>
                            <input type="hidden">
                        </form>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">

                        <h5 class="mb-4 mb-xs-4">Ubah Sandi</h5>

                        <form id="formAccountSettings" method="POST" action="/user/postUbahSandi" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="sandiLama">Sandi Lama</label>
                                    <div class="input-group input-group-merge has-validation">
                                        <input class="form-control" type="password" name="sandiLama" id="sandiLama" placeholder="············">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="sandiBaru">Sandi Baru</label>
                                    <div class="input-group input-group-merge has-validation">
                                        <input class="form-control" type="password" id="sandiBaru" name="sandiBaru" placeholder="············" value="<?=$_POST['sandiBaru'] ?? ''?>">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>        
                                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="konfirmasiSandi">Konfirmasi Sandi Baru</label>
                                    <div class="input-group input-group-merge has-validation">
                                        <input class="form-control" type="password" name="konfirmasiSandi" id="konfirmasiSandi" placeholder="············" value="<?=$_POST['konfirmasiSandi'] ?? ''?>">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="fw-medium mt-2">Persyaratan Sandi:</p>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Panjang minimal 8 karakter</li>
                                        <li class="mb-1">Minimal terdapat 1 huruf besar / kecil</li>
                                        <li>Setidaknya satu angka, simbol, atau karakter spasi</li>
                                    </ul>
                                </div>
                                <div class="col-12 mt-1">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Batal</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>