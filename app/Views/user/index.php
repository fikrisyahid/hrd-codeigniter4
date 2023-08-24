<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="row">
      <h1 class="mt-5 ml-3">Selamat Datang <?= user()->username; ?>!</h1>
    </div>
    <div class="row my-5">
      <div class="col-xl-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                  Karyawan Aktif</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $karyawan_aktif ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-people-carry fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                  Karyawan Cuti</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $karyawan_cuti ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-bed fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-danger text-uppercase mb-1">
                  Karyawan Resign</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $karyawan_resign ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user-slash fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid d-flex justify-content-center my-5">
      <div class="col-md-6">
        <!-- Karyawan -->
        <canvas id="karyawan"></canvas>

        <?php
        $barujoin = (int)substr($tanggal_gabung_desc[0]['tanggal_gabung'], 0, 4);
        $lamajoin = (int)substr($tanggal_gabung_asc[0]['tanggal_gabung'], 0, 4);
        $list_bulan = [];

        // Menyediakan tempat untuk menyimpan jumlah karyawan per tahun
        for ($x = $lamajoin; $x <= $barujoin; $x++) {
          array_push($list_bulan, 0);
        }

        // Memasukkan jumlah karyawan per tahun ke slot tahunnya
        foreach ($tanggal_gabung_desc as $x) {
          $temp = (int)substr($x['tanggal_gabung'], 0, 4);
          $list_bulan[$temp - $lamajoin] += 1;
        }

        ?>

        <script>
          var ctx = document.getElementById('karyawan').getContext('2d');
          var karyawan = new Chart(ctx, {
            type: 'line',
            data: {
              labels: [
                <?php
                for ($x = $lamajoin; $x <= $barujoin; $x++) {
                  if ($x != $barujoin) {
                    echo "$x,";
                  } else {
                    echo $x;
                  }
                }
                ?>
              ],
              datasets: [{
                data: [
                  <?php
                  for ($x = 0; $x < count($list_bulan); $x++) {
                    if ($x != count($list_bulan) - 1) {
                      echo "$list_bulan[$x],";
                    } else {
                      echo $list_bulan[$x];
                    }
                  }
                  ?>
                ],
                backgroundColor: '#7a8fe6'
              }]
            },
            options: {
              legend: {
                display: false
              },
              title: {
                display: true,
                text: 'Jumlah Karyawan Bergabung Pertahun',
                fontSize: 18
              }
            }
          });
        </script>
      </div>

      <div class="col-fluid">
        <h5 style="text-align: center; font-weight: bold;">Karyawan Terkini</h5>
        <table class="table" data-sortable="true" data-toggle="table">
          <thead>
            <tr>
              <th data-switchable="false" data-sortable="true" data-halign="left" data-align="center">No</th>
              <th data-sortable="true" data-halign="left" data-align="center">ID Karyawan</th>
              <th data-sortable="true" data-halign="left" data-align="center">Nama</th>
              <th data-sortable="true" data-halign="left" data-align="center">Jenis Kelamin</th>
              <th data-sortable="true" data-halign="left" data-align="center">Tanggal Gabung</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0; ?>
            <?php for ($x = 0; $x < 5; $x++) : ?>
              <tr class="tabelTengah">
                <th scope="row"><?= ++$i ?></th>
                <td><?= $tanggal_gabung_desc[$x]['id_karyawan'] ?></td>
                <td><?= $tanggal_gabung_desc[$x]['nama'] ?></td>
                <td><?= $tanggal_gabung_desc[$x]['jenis_kelamin'] ?></td>
                <td><?= $tanggal_gabung_desc[$x]['tanggal_gabung'] ?></td>
              </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row my-5">
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                  Rekrutmen Direkomendasikan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rekrutmen_direkomendasikan ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-child fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                  Rekrutmen Antri</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rekrutmen_antri ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user-clock fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-danger text-uppercase mb-1">
                  Rekrutmen Ditolak</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rekrutmen_ditolak ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users-slash fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?= $this->endSection(); ?>