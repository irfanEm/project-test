<div class="container-xxl flex-grow-1 container-p-y">

    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <?= $model['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"button>
        </div>
    <?php } ?>

    <div class="row fv-plugins-icon-container">
        <div class="col-md-12">
            <div class="d-flex justify-content-end my-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                    Tambah grup
                </button>
            </div>
            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header text-capitalize"><?= $model['heading'] ?? "List grup telegram"?></h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover table-striped table-borderless">
                    <thead>
                        <tr>
                        <th>ID Grup</th>
                        <th>Nama Grup</th>
                        <th>User Grup</th>
                        <th>Waktu Input</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $n=1; foreach($model['grups'] as $grup) { ?>
                        <tr>
                            <td><strong><?= $grup['id_grup'] ?? '' ?></strong></td>
                            <td><?= $grup['nama_grup'] ?? '' ?></td>
                            <td><a href="https://t.me/<?= $grup['user_grup'] ?>"><?= $grup['user_grup'] ?? '' ?></a></td>
                            <td><?= $grup['time_add'] ?? '' ?></td>
                            <td>
                                <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/grup/edit/<?= $grup['id_grup'] ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="/grup/hapus/<?= $grup['id_grup'] ?>"
                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                    >
                                </div>
                                </div>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                    </table>
                </div>
            </div>
            <!--/ Hoverable Table rows -->

            <!-- Vertically Centered Modal -->
            <div class="col-lg-12 col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Tambah grup</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
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
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
              