<!DOCTYPE html>
<html>

<head>
  <title>Status Gizi Balita</title>
</head>

<body>
  <h1>Status Gizi Balita</h1>
  <form method="post" action="<?php echo base_url('knn/test'); ?>">
    <label for="usia">Usia (bulan):</label>
    <input type="number" name="usia" required step="0.01" value="<?= set_value('usia') ?>"><br><br>

    <label for="berat_badan">Berat Badan (kg):</label>
    <input type="number" name="berat_badan" required step="0.01" value="<?= set_value('berat_badan') ?>"><br><br>

    <label for="tinggi_badan">Tinggi Badan (cm):</label>
    <input type="number" name="tinggi_badan" required step="0.01" value="<?= set_value('tinggi_badan') ?>"><br><br>

    <label for="status_gizi">Status Berat:</label>
    <input type="text" name="status_berat" value="<?php echo $status_berat ?>" readonly><br><br>

    <label for="status_gizi">Status Tinggi:</label>
    <input type="text" name="status_tinggi" value="<?php echo $status_tinggi ?>" readonly><br><br>

    <label for="status_gizi">Status Gizi:</label>
    <input type="text" name="status_gizi" value="<?php echo $status_gizi ?>" readonly><br><br>


    <input type="submit" value="Submit">
  </form>
  <br><br>
  <hr><br><br>
  <?php if ($jarak_gizi) : ?>
    <h2>Daftar Jarak Gizi Terdekat</h2>
    <table>
      <thead>
        <tr>
          <td>#</td>
          <td>Usia</td>
          <td>Berat Badan</td>
          <td>Tingi Badan</td>
          <!-- <td>Jarak Berat</td>
          <td>Status Berat</td>
          <td>Jarak Tinggi</td>
          <td>Status Tinggi</td> -->
          <td>Status Gizi</td>
          <td>Jarak Gizi</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($jarak_gizi as $jg) : ?>
          <tr>
            <td><?= $jg['id'] ?></td>
            <td><?= $jg['usia'] ?></td>
            <td><?= $jg['bb'] ?></td>
            <td><?= $jg['tb'] ?></td>
            <!-- <td><?= $jg['jarakberat']; ?></td>
            <td><?= $jg['sberat']; ?></td>
            <td><?= $jg['jaraktinggi']; ?></td>
            <td><?= $jg['stinggi']; ?></td> -->
            <td><?= $jg['sgizi']; ?></td>
            <td><?= $jg['jarak'] ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
  <hr>
  <?php if ($jarak_berat) : ?>
    <h2>Daftar Jarak Berat Terdekat</h2>
    <table>
      <thead>
        <tr>
          <td>#</td>
          <td>Usia</td>
          <td>Berat Badan</td>
          <td>Tingi Badan</td>
          <!-- <td>Jarak Berat</td>
          <td>Status Berat</td>
          <td>Jarak Tinggi</td>
          <td>Status Tinggi</td> -->
          <td>Status Berat</td>
          <td>Jarak Berat</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($jarak_berat as $jb) : ?>
          <tr>
            <td><?= $jb['id'] ?></td>
            <td><?= $jb['usia'] ?></td>
            <td><?= $jb['bb'] ?></td>
            <td><?= $jb['tb'] ?></td>
            <!-- <td><?= $jb['jarakberat']; ?></td>
            <td><?= $jb['sberat']; ?></td>
            <td><?= $jb['jaraktinggi']; ?></td>
            <td><?= $jb['stinggi']; ?></td> -->
            <td><?= $jb['sberat']; ?></td>
            <td><?= $jb['jarak'] ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
  <hr>
  <?php if ($jarak_tinggi) : ?>
    <h2>Daftar Jarak Tinggi Terdekat</h2>
    <table>
      <thead>
        <tr>
          <td>#</td>
          <td>Usia</td>
          <td>Berat Badan</td>
          <td>Tingi Badan</td>
          <!-- <td>Jarak Berat</td>
          <td>Status Berat</td>
          <td>Jarak Tinggi</td>
          <td>Status Tinggi</td> -->
          <td>Status Tinggi</td>
          <td>Jarak Tinggi</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($jarak_tinggi as $jt) : ?>
          <tr>
            <td><?= $jt['id'] ?></td>
            <td><?= $jt['usia'] ?></td>
            <td><?= $jt['bb'] ?></td>
            <td><?= $jt['tb'] ?></td>
            <!-- <td><?= $jt['jarakberat']; ?></td>
            <td><?= $jt['sberat']; ?></td>
            <td><?= $jt['jaraktinggi']; ?></td>
            <td><?= $jt['stinggi']; ?></td> -->
            <td><?= $jt['stinggi']; ?></td>
            <td><?= $jt['jarak'] ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</body>

</html>