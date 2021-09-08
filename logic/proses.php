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