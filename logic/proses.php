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
    public function print_country($counter)
    {
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

class rumah_sakit{
    public $provinsi;
    public $kota;
    public $hospital;
    public $hospital_parsing;
    public function __construct($province, $city, $json){
        $this->provinsi = $province;
        $this->kota = $city;
        $this->hospital = file_get_contents($json);
        $this->hospital_parsing = json_decode($this->hospital, true);

    }
    public function print_hospital_name($count){
        return $this->hospital_parsing["hospitals"][$count]["name"];
    }
    public function looping(){
        $loop = $this->hospital_parsing["hospitals"];
        $ulang = sizeof($loop);
        return $ulang;
    }
    public function print_hospital_address($count){
        return $this->hospital_parsing["hospitals"][$count]["address"];
    }
    public function print_hospital_available($count){
        return $this->hospital_parsing["hospitals"][$count]["bed_availability"];
    }
    public function print_hospital_phone($count){
        return $this->hospital_parsing["hospitals"][$count]["phone"];
    }
    public function print_hospital_update($count){
        return $this->hospital_parsing["hospitals"][$count]["info"];
    }
}


$indo = new virus($_POST['daerah'], 'https://api.kawalcorona.com/indonesia/provinsi/');
$global = new virus(0, 'https://api.kawalcorona.com/');

$hospital = new rumah_sakit($_POST['prov'], $_POST['gedung'], 'https://rs-bed-covid-api.vercel.app/api/get-hospitals?provinceid='. $_POST['prov'] .'&cityid='. $_POST['gedung'] .'&type=1');

?>
