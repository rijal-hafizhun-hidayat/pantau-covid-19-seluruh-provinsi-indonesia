<?php
$number = 0;
$daerah = 0;
//data provinsi indonesia
$data = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi/');
$covid = json_decode($data, true);

//data global
$global = file_get_contents('https://api.kawalcorona.com/');
$parsing_global = json_decode($global, true);
// var_dump($parsing_global); die();
//var_dump($covid);die();
// echo $covid[0]["attributes"]["Provinsi"];
// echo $covid[0]["attributes"]["Kasus_Posi"];
if (isset($_POST["masuk"])) {
  $daerah = $_POST["daerah"];
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="covid 19, web pantau covid 19, website pantau covid 19">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

  <title>Pantau Covid 19 Indonesia</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="cont text-center">
        <h1>Pantau Data Covid 19</h1>
        <h3>Seluruh Provinsi Indonesia</h3>
      </div>
      <div class="bungkus">
        <form action="" method="post">
          <select name="daerah">
            <option selected value="0">DKI Jakarta</option>
            <option value="1">Jawa Barat</option>
            <option value="2">Jawa Tengah</option>
            <option value="3">Jawa Timur</option>
            <option value="4">Kalimantan Timur</option>
            <option value="11">Kalimantan selatan</option>
            <option value="15">Kalimantan Tengah</option>
            <option value="20">Kalimantan Utara</option>
            <option value="28">Kalimantan Barat</option>
            <option value="5">Sulawesi Selatan</option>
            <option value="16">Sulawesi Utara</option>
            <option value="19">Sulawesi Tengah</option>
            <option value="23">Sulawesi Tenggara</option>
            <option value="6">Banten</option>
            <option value="7">Bali</option>
            <option value="8">Riau</option>
            <option value="9">Daerah Istimewa Yogyakarta</option>
            <option value="10">Sumatera Barat</option>
            <option value="14">Sumatera Selatan</option>
            <option value="12">Sumatera Utara</option>
            <option value="13">Papua</option>
            <option value="17">Nusa Tenggara Timur</option>
            <option value="24">Nusa Tenggara Barat</option>
            <option value="18">Bangka Belitung</option>
            <option value="21">Lampung</option>
            <option value="22">Aceh</option>
            <option value="25">Kepulauan Riau</option>
            <option value="26">Papua Barat</option>
            <option value="25">Maluku</option>
            <option value="29">Jambi</option>
            <option value="30">Bengkulu</option>
            <option value="31">Sulawesi Barat</option>
            <option value="32">Gorontali</option>
            <option value="33">Maluku Utara</option>
          </select>
          <input type="submit" name="masuk" value="Submit">
        </form>
        <h3>Data Untuk Daerah = <?php echo $covid[$daerah]["attributes"]["Provinsi"]; ?></h3>
      </div>
      <div class="col-sm-4">
        <div class="card bg-warning">
          <div class="card-body">
            <p>Total Kasus Positif</p>
            <p><?php echo $covid[$daerah]["attributes"]["Kasus_Posi"]; ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card bg-success">
          <div class="card-body">
            <p>Total Kasus Sembuh</p>
            <p><?php echo $covid[$daerah]["attributes"]["Kasus_Semb"]; ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card bg-danger">
          <div class="card-body">
            <p>Total Kasus Meninggal</p>
            <p><?php echo $covid[$daerah]["attributes"]["Kasus_Meni"]; ?></p>
          </div>
        </div>
      </div>
      <h3>kasus corona virus global</h3>
      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Negara</th>
              <th scope="col">Positif</th>
              <th scope="col">Sembuh</th>
              <th scope="col">Meninggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i = 0; $i < 195; $i++) {
              $number++;
            ?>
              <tr>
                <th scope="row"><?php echo $number; ?></th>
                <td><?php echo $parsing_global[$i]["attributes"]["Country_Region"]; ?></td>
                <td><?php echo $parsing_global[$i]["attributes"]["Confirmed"]; ?></td>
                <td><?php echo $parsing_global[$i]["attributes"]["Recovered"]; ?></td>
                <td><?php echo $parsing_global[$i]["attributes"]["Deaths"]; ?></td>
              </tr>
            <?php }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>
