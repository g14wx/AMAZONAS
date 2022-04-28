<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class userController extends Controller
{
    public function hour(): JsonResponse
    {
        return response()->json(["hour" => Carbon::today()->toString()]);
    }

    public function newusr(): JsonResponse
    {
        return response()->json(["hello user!"]);
    }

    public function textMessageCampaignHealth()
    {
        $titles = ["Total Campaigns", "Total Messages", "Delivery Rate", "CTR", "Opt-out Rate"];
        $titlesForSeries = ["Total Messages", "Delivery Rate", "CTR", "Opt-out Rate"];
        $response = [
            "cards" => $this->generateCards($titles),
            "series" => $this->generateSeries($titlesForSeries)
        ];
        return response()->json($response);
    }

    public function emailCampaignHealth()
    {
        $titles = ["Total Campaigns", "Total Emails", "Delivery Rate", "Open Rate", "CTR", "Unsubscribe Rate"];
        $titlesForSeries = ["Total Emails", "Delivery Rate", "Open Rate", "CTR", "Unsubscribe Rate"];
        $response = [
            "cards" => $this->generateCards($titles),
            "series" => $this->generateSeries($titlesForSeries)
        ];
        return response()->json($response);
    }

    private function generateSeries(array $titles): array
    {

        $collection = Collection::make($titles);
        $faker = Faker::create();

        $d1 = date_create(date('Y').'-'.date('m').'-01'); //current month/year
        $d2 = date_create($d1->format('Y-m-t')); //get last date of the month
        $daysObject = date_diff($d1,$d2);
        $days = Collection::range(0,$daysObject->days+1);
        unset($titles[0]);
        $series = $collection->map(function ($title) use($days, $faker) {
            return [
                "title" => $title,
                "data" => $days->map(function ($day) use ($faker) {
                    return [
                        "numberOfDay" => $day,
                        "value" => $faker->numberBetween(1,999999)
                    ];
                })->toArray(),
                "subInformation" => $days->map(function ($day) use ($faker, $title) {
                return [
                    "title" => $title,
                    "date" => $day."-".Carbon::now()->format("m-Y"),
                    "monthInformation" => Collection::make([0,1,2])->map(function ($number) use ($faker){
                        $monthInformation = [
                            "title" => $faker->name,
                            "value" => $faker->numberBetween(1,999999),
                            "isPercentageValue" => ($faker->numberBetween(1,2) == 1)
                        ];
                        if($number == 2) {
                            $monthInformation["isPositivePercentage"] = ($faker->numberBetween(1,2) == 1);
                            $monthInformation["percentage"] = $faker->numberBetween(1,100);
                        }
                        return $monthInformation;
                    })->toArray()
                ];
                })->toArray()

            ];
        });
        return $series->toArray();
    }

    private function generateCards(array $titles): array
    {
        $faker = Faker::create();
        $collection = Collection::make($titles);
        $cards = $collection->map(function ($title) use ($faker) {
            return [
                "title" => $title,
                "value" => $faker->numberBetween(1,999999),
                "percentage" => $faker->numberBetween(1,100)."%",
                "isPositivePercentage" => ($faker->numberBetween(1,2) == 1)
            ];
        });
        return $cards->toArray();
    }
}
