<div class="container-xxl flex-grow-1 container-p-y">

    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <?= $model['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"button>
        </div>
    <?php } ?>

    <div class="row fv-plugins-icon-container">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header"><?= $model['heading'] ?? 'Tambah grup baru'?></h5>
                <div class="card-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="idGrup" name="id_grup" placeholder="0798635421" aria-describedby="floatingInputHelp">
                        <label for="idGrup">ID Grup</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama_grup" name="nama_grup" placeholder="Grup Contoh" aria-describedby="floatingInputHelp">
                        <label for="nama_grup">Nama Grup</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="user_grup" name="user_grup" placeholder="t.me/grup_contoh" aria-describedby="floatingInputHelp">
                        <label for="user_grup">Username Grup</label>
                    </div>
                    <div class="form-floating">
                        <button type="submit" class="btn rounded-pill btn-primary">Simpan</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>