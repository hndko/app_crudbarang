<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="#">Product</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Home' ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Kategori' ? 'active' : '' ?>" href="<?= base_url('kategori') ?>">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $title == 'Barang' ? 'active' : '' ?>" href="<?= base_url('barang') ?>">Barang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>