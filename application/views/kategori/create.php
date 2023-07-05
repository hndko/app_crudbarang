<main>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between">
                Tambah Data Kategori
                <a href="#" class="btn btn-warning btn-sm" onclick="history.back()">Kembali</a>
            </div>
            <form action="<?= base_url('kategori/create') ?>" method="post">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" autocomplete="off" value="<?= set_value('nama_kategori') ?>">
                            <div id="alertHelper" class="form-text text-danger"><?= form_error('nama_kategori') ?></div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>