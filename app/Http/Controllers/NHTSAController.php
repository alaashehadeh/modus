<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Connector\NHTSAConnector;
use helpers\NHTSAHelper;
use Illuminate\Support\Facades\Response;

class NHTSAController extends Controller
{
    private $NHTSAConnector;

    public function __construct(NHTSAConnector $NHTSAConnector)
    {
        $this->NHTSAConnector = $NHTSAConnector;
    }

    public function getYearModelManufacture(Request $request, $year, $model, $manufacture)
    {
        $data = $this->NHTSAConnector->getYearModelManufacture($year, $model, $manufacture);
        $data = NHTSAHelper::yearModelManufactureHelper($data);
        if ($request->withRating) {
            if ($data['Count'] > 0) {
                foreach ($data['Results'] as $key => $value) {
                    $data['Results'][$key]['CrashRating'] = $this->NHTSAConnector->getVehicleRate($value['VehicleId']);
                }
            }
        }
        return response()->json($data, 200);

    }

    public function postYearModelManufacture(Request $request)
    {
        if (empty($request->modelYear) || empty($request->model) || empty($request->manufacturer)) {
            return response()->json(array('Error' => 'Error in form fields'), 404);
        } else {
            $data = $this->NHTSAConnector->getYearModelManufacture($request->modelYear, $request->model, $request->manufacturer);
            $data = NHTSAHelper::yearModelManufactureHelper($data);
            return response()->json($data, 200);
        }
    }
}
