<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Helo cuy!</h1>
  <hr>
  <br>

  <form action="welcome" method="post">
    <input type="number" name="input1">
    <input type="number" name="input2">
    <button type="submit">Cek</button>
  </form>

  <p>Status warna : <?= $hasil ?></p>

  <br>
  <hr>
  <p>batasnya</p>
</body>

</html>