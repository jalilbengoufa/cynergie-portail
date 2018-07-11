<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Counter;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class DataController extends Controller
{
    private $prometheusUrl = "http://0.0.0.0:3000/test.json";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $client = new Client();
        $date = $request->input('date');
        $from = $request->input('from');
        $to = $request->input('to');
        $csv = (bool)$request->input('csv');

        if (isset($date) && $date !== null && $date !== "") {

            $validatedData = $request->validate([
                'counter' => 'string|required|max:255',
                'date' => 'date|required',
            ]);

           return response()->json($this->getDataDay($validatedData, $client)) ;

           /* if ( $filteredJson !== null) {

                $this->dataToCsv($filteredJson);
            }*/

            return response()->json("empty json file , verify and try again", 400);;
        }

        if (isset($from) && $from !== "" && isset($to) && $to !== "") {

            $validatedData = $request->validate([
                'counter' => 'string|required|max:255',
                'from' => 'date|required',
                'to' => 'date|required',
            ]);

            $this->getDataMultipleDays($validatedData, $client);

            if (isset($csv) && $csv) {
                $this->dataToCsv();
            }

        }


        return response()->json("bad parameters , verify and try again", 400);

    }


    /**help functions**/

    /**
     * @param $dataDay
     * @param $client
     * @return mixed
     */
    private function getDataDay($dataDay, $client)
    {
        $metrics = array();
        // $prometheusData = $client->get($this->prometheusUrl);
        // $prometheusJson = prometheusData->getBody()->getContents()
        $requestJson = Request::create(route("prometheus"), "GET");
        $prometheusJson = app()->handle($requestJson)->getContent();
        $prometheusArray = json_decode($prometheusJson);

        foreach ($prometheusArray->data->result as $result) {

            $values = $result->values;
            $metric = array();

            foreach ($values as $value) {

                $metric["name"] = $result->metric->job;
                $metric["value"] = $value[1];
                $metric["time"] = $value[0];
                array_push($metrics, $metric);
            }


        }

        if (empty($metrics)) {
            return false;
        }

        return json_encode($metrics);

    }

    /**
     * @param $dataMultipleDays
     * @param $client
     */
    private function getDataMultipleDays($dataMultipleDays, $client)
    {
        $prometheusUrl = "https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js";

        //$prometheusData = $client->get($this->prometheusUrl);
        //dd($prometheusData->getBody()->getContents());


    }

    /**
     * @return string list of all controllers names
     */
    public function getNames()
    {
        return Counter::all("name")->toJson(JSON_PRETTY_PRINT);
    }
}
