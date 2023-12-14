                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 mb-4 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-12">
                                    <div class="card-header">
                                        <h4>Perbarui profil</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" aria-describedby="floatingInputHelp" value="<?= $model['user']['nama'] ?? "" ?>">
                                            <label for="nama">Nama</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Nama" aria-describedby="floatingInputHelp" value="<?= $model['user']['username'] ?? "" ?>">
                                            <label for="username">Username</label>
                                        </div>
                                        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">
                                            Perbarui
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>