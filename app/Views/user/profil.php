<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mt-2">
      <h1 class="h3 mb-4 text-gray-800">Halaman Profil</h1>
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4 mb-3">
            <img src="<?= base_url('/img/' . user()->user_image); ?>" class="card-img ml-3 mt-3" alt="<?= user()->username; ?>">
          </div>
          <div class="col-md-8">
            <div class="card-body mt-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= user()->username; ?></li>
                <li class="list-group-item"><?= user()->email; ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>