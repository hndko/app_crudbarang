<main>
    <div class="container pt-5">
        <div class="pb-3 text-end">
            <?php
            function tgl_indo($tanggal)
            {
                $bulan = array(
                    1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
                $pecahkan = explode('-', $tanggal);

                // variabel pecahkan 0 = tanggal
                // variabel pecahkan 1 = bulan
                // variabel pecahkan 2 = tahun

                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
            }

            echo tgl_indo(date('Y-m-d'));
            ?>
        </div>
        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between">
                List Barang
                <a href="<?= base_url('barang/create') ?>" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('message') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="text-end">
                    <form action="<?= base_url('barang') ?>" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search your serial number" value="<?= $this->input->get('search') ?>" autocomplete="off">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered border-dark table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Serial Number</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $this->uri->segment(3) + 1; ?>
                            <?php foreach ($result as $res) : ?>
                                <tr>
                                    <th class="text-center align-middle"><?= $no++ ?></th>
                                    <td class="align-middle"><?= $res->serial_number ?></td>
                                    <td class="align-middle"><?= $res->nama_barang ?></td>
                                    <td class="align-middle"><?= $res->nama_kategori ?></td>
                                    <td class="align-middle"><img src="<?= base_url() ?>uploads/<?= $res->gambar ?>" width="150px"></td>
                                    <td class="align-middle"><?= $res->keterangan ?></td>
                                    <td class="align-middle">
                                        <a href="<?= base_url('barang/detail/' . $res->barang_id) ?>" class="btn btn-info btn-sm">Detail</a>
                                        <a href="<?= base_url('barang/edit/' . $res->barang_id) ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="<?= base_url('barang/delete/' . $res->barang_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pagination ?>
                </div>
            </div>
        </div>
    </div>
</main>