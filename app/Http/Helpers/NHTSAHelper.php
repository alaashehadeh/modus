<?php

namespace helpers;


class NHTSAHelper
{
    static public function yearModelManufactureHelper($data)
    {
        $output = array('Count' => $data['Count'], 'Results' => array());
        foreach ($data['Results'] as $key => $value) {
            $output['Results'][$key]['Description'] = $value['VehicleDescription'];
            $output['Results'][$key]['VehicleId'] = $value['VehicleId'];
        }
        return $output;
    }

}