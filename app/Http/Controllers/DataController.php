<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Counter;
use App\Helpers\Filter;


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

        if (isset($date) && $date !== null && $date !== "") {

            $validatedData = $request->validate([
                'counter' => 'string|required|max:255',
                'date' => 'date|required',
            ]);

           return response()->json(Filter::getDataDay($validatedData, $client)) ;

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


    /**
     * @return string list of all controllers names
     */
    public function getNames()
    {
        return Counter::all("name")->toJson(JSON_PRETTY_PRINT);
    }
}
