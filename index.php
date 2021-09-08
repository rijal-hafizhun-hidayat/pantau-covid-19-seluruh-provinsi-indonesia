<?php
error_reporting(0);
class virus
{
    public $daerah;
    public $data;
    public $covid;
    public function __construct($area, $stat)
    {
        $this->daerah = $area;
        $this->data = file_get_contents($stat);
        $this->covid = json_decode($this->data, true);
    }
    public function cetak_data_provinsi()
    {
        return $this->covid[$this->daerah]["attributes"]["Provinsi"];
    }
    public function cetak_data_positif()
    {
        return $this->covid[$this->daerah]["attributes"]["Kasus_Posi"];
    }
    public function cetak_data_sembuh()
    {
        return $this->covid[$this->daerah]["attributes"]["Kasus_Semb"];
    }
    public function cetak_data_meninggal()
    {
        return $this->covid[$this->daerah]["attributes"]["Kasus_Meni"];
    }
    public function print_country($counter){
        return $this->covid[$counter]["attributes"]["Country_Region"];
    }
    public function print_positive($counter)
    {
        return $this->covid[$counter]["attributes"]["Country_Confirmed"];
    }
    public function print_recovered($counter)
    {
        return $this->covid[$counter]["attributes"]["Recovered"];
    }
    public function print_dead($counter)
    {
        return $this->covid[$counter]["attributes"]["Deaths"];
    }
}

$indo = new virus($_POST['daerah'], 'https://api.kawalcorona.com/indonesia/provinsi/');
$global = new virus(0, 'https://api.kawalcorona.com/');

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

    <title>Hello, world!</title>
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
                <h3>Data Untuk Daerah = <?php echo $indo->cetak_data_provinsi(); ?></h3>
            </div>
            <div class="col-sm-4">
                <div class="card bg-warning">
                    <div class="card-body">
                        <p>Total Kasus Positif</p>
                        <p><?php echo $indo->cetak_data_positif(); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-success">
                    <div class="card-body">
                        <p>Total Kasus Sembuh</p>
                        <p><?php echo $indo->cetak_data_sembuh(); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger">
                    <div class="card-body">
                        <p>Total Kasus Meninggal</p>
                        <p><?php echo $indo->cetak_data_meninggal(); ?></p>
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
                                <td><?php echo $global->print_country($i)?></td>
                                <td><?php echo $global->cetak_data_positif($i) ?></td>
                                <td><?php echo $global->print_recovered($i) ?></td>
                                <td><?php echo $global->print_dead($i) ?></td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>
