<main>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between">
                Tambah Data Barang
                <a href="#" class="btn btn-warning btn-sm" onclick="history.back()">Kembali</a>
            </div>
            <form action="<?= base_url('barang/edit/' . $res->barang_id) ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="serial_number" class="col-sm-2 col-form-label">Serial Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="serial_number" id="serial_number" autocomplete="off" value="<?= $res->serial_number ?>" readonly>
                            <div id="alertHelper" class="form-text text-danger"><?= form_error('serial_number') ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" autocomplete="off" value="<?= $res->nama_barang ?>">
                            <div id="alertHelper" class="form-text text-danger"><?= form_error('nama_barang') ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select name="kategori_id" id="kategori_id" class="form-select">
                                <option value="">--- Pilih Kategori ---</option>
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat->kategori_id ?>" <?= $res->kategori_id == $kat->kategori_id ? 'selected' : '' ?>><?= $kat->nama_kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="alertHelper" class="form-text text-danger"><?= form_error('kategori_id') ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="gambar" id="gambar" autocomplete="off" value="<?= set_value('gambar') ?>">
                            <div id="alertHelper" class="form-text text-danger"><?= form_error('gambar') ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control"><?= $res->keterangan ?></textarea>
                            <div id="alertHelper" class="form-text text-danger"><?= form_error('keterangan') ?></div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>