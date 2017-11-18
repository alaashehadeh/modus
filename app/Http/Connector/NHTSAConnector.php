<?php
namespace Connector;

use League\Flysystem\Exception;

class NHTSAConnector
{
    private $arrContextOptions;

    public function __construct()
    {
        $this->baseUrl = 'https://one.nhtsa.gov/webapi/api/SafetyRatings/';
        $this->arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $this->arrContextOptions = stream_context_create($this->arrContextOptions);
    }

    public function getYearModelManufacture($year, $manufacture, $model)
    {
        $url = $this->baseUrl . 'modelyear/' . urlencode($year) . '/make/' . urlencode($manufacture) . '/model/' . urlencode($model) . '?format=json';

        $data = @file_get_contents($url, false, $this->arrContextOptions);
        if (!$data) {
            $data = array('Count' => 0, 'Results' => array());
            return $data;
        } else {
            return json_decode($data, true);
        }
    }

    public function getVehicleRate($vehicle_id)
    {
        $url = $this->baseUrl . 'VehicleId/' . $vehicle_id . '?format=json';
        $data = file_get_contents($url, false, $this->arrContextOptions);
        $data = json_decode($data, false);
        return $data->Results[0]->OverallRating;
    }
}