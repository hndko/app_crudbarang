<main>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between">
                List Kategori
                <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('message') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered border-info table-hover">
                        <thead class="table-info">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($result as $res) : ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?></th>
                                    <td><?= $res->nama_kategori ?></td>
                                    <td>
                                        <a href="<?= base_url('kategori/edit/' . $res->kategori_id) ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="<?= base_url('kategori/delete/' . $res->kategori_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>