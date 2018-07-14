<?php
/**
 * Created by PhpStorm.
 * User: django
 * Date: 7/11/18
 * Time: 9:46 PM
 */
namespace App\Helpers;
use Illuminate\Http\Request;
class Filter
{


    public static function getDataDay($dataDay, $client)
    {

        // $prometheusData = $client->get($this->prometheusUrl);
        // $prometheusJson = prometheusData->getBody()->getContents()
        $metrics = array();
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

    public static function getDataMultipleDays($dataMultipleDays, $client)
    {
        $prometheusUrl = "https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js";

        //$prometheusData = $client->get($this->prometheusUrl);
        //dd($prometheusData->getBody()->getContents());

    }

}