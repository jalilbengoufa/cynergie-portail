<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DataController extends Controller
{

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

            $this->getDataDay($validatedData, $client);

            if(isset($csv) && $csv){
                $this->dataToCsv();
            }
        }

        if (isset($from) && $from !== "" && isset($to) && $to !== "") {

            $validatedData = $request->validate([
                'counter' => 'string|required|max:255',
                'from' => 'date|required',
                'to' => 'date|required',
            ]);

            $this->getDataMultipleDays($validatedData, $client);

            if(isset($csv) && $csv){
                $this->dataToCsv();
            }

        }


        return response()->json("bad parameters , verify and try again", 400);

    }

    /**
     * @param $dataDay
     * @param $client
     */
    private function getDataDay($dataDay, $client)
    {

        $prometheusUrl = "https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js";

        $prometheusData = $client->get($this->prometheusUrl);
        dd($prometheusData->getBody()->getContents());

        // return view('home');
    }

    /**
     * @param $dataMultipleDays
     * @param $client
     */
    private function getDataMultipleDays($dataMultipleDays, $client)
    {
        $prometheusUrl = "https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js";
        
        $prometheusData = $client->get($this->prometheusUrl);
        dd($prometheusData->getBody()->getContents());

        //return view('home');
    }

    /**
     * @param $data
     * @return mixed
     */
    private function dataToCsv($data)
    {


        return $data;
    }
}
