<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function topAndTransaction(): JsonResponse
    {
        $response = [
            "top_selling_categories",
            "top_selling_products",
            "transaction_amount_per_visit"
        ];
        return response()->json($response);
    }

    public function subscriberGrowth(): JsonResponse
    {
        $titles = ["Total Active Subscribers", "Total Opt-ins", "Total Opt-outs"];
        $titlesForSeries = ["Subscribers"];
        $response = [
            "cards" => $this->generateCards($titles),
            "series" => $this->generateSeries($titlesForSeries, true)[0]
        ];
        return response()->json($response);
    }

    public function salesVsCampaign(): JsonResponse
    {
        $titles = ["Total Sales connected to campaigns", "Average daily sales"];
        $titlesForSeries = ["Sales", "Text Campaigns", "Email Campaigns"];
        $response = [
            "informativeCards" => Collection::make($this->generateCards($titles))->map(function ($informativeCard) {
                return [
                    "title" => $informativeCard["title"],
                    "data" => $informativeCard
                ];
            })->toArray(),
            "series" => $this->generateSeries($titlesForSeries, true)
        ];
        return response()->json($response);
    }

    public function textMessageCampaignHealth(): JsonResponse
    {
        $titles = ["Total Campaigns", "Total Messages", "Delivery Rate", "CTR", "Opt-out Rate"];
        $titlesForSeries = ["Total Messages", "Delivery Rate", "CTR", "Opt-out Rate"];
        $response = [
            "cards" => $this->generateCards($titles),
            "series" => $this->generateSeries($titlesForSeries)
        ];
        return response()->json($response);
    }

    public function emailCampaignHealth(): JsonResponse
    {
        $titles = ["Total Campaigns", "Total Emails", "Delivery Rate", "Open Rate", "CTR", "Unsubscribe Rate"];
        $titlesForSeries = ["Total Emails", "Delivery Rate", "Open Rate", "CTR", "Unsubscribe Rate"];
        $response = [
            "cards" => $this->generateCards($titles),
            "series" => $this->generateSeries($titlesForSeries)
        ];
        return response()->json($response);
    }

    private function generateSeries(array $titles, bool $setDataToNumbers = false): array
    {

        $collection = Collection::make($titles);
        $d1 = date_create(date('Y') . '-' . date('m') . '-01'); //current month/year
        // @phpstan-ignore-next-line
        $d2 = date_create($d1->format('Y-m-t')); //get last date of the month
        // @phpstan-ignore-next-line
        $daysObject = date_diff($d1, $d2);
        $days = Collection::range(0, $daysObject->days + 1);
        unset($titles[0]);
        $series = $collection->map(function ($title) use ($days, $setDataToNumbers) {
            return [
                "title" => $title,
                "data" => $days->map(function ($day) use ($setDataToNumbers) {
                    return $setDataToNumbers ? mt_rand(1, 999999) : [
                        "numberOfDay" => $day,
                        "value" => mt_rand(1, 999999)
                    ];
                })->toArray(),
                "subInformation" => $days->map(function ($day) use ($title, $setDataToNumbers) {
                    return [
                        "title" => $title,
                        "date" => Carbon::now()->format("Y-m"). "-" . $day,
                        "monthInformation" => Collection::make($setDataToNumbers ? [0, 1, 2] : [0, 1])->map(function ($number) use ($setDataToNumbers) {
                            $monthInformation = [
                                "title" => "some title",
                                "value" => mt_rand(1, 999999),
                                "isPercentageValue" => (mt_rand(1, 2) == 1)
                            ];
                            if ($number == 1 || $setDataToNumbers) {
                                $monthInformation["isPositivePercentage"] = (mt_rand(1, 2) == 1);
                                $monthInformation["percentage"] = mt_rand(1, 100);
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

        $collection = Collection::make($titles);
        $cards = $collection->map(function ($title) {
            return [
                "title" => $title,
                "value" => mt_rand(1, 999999),
                "percentage" => mt_rand(1, 100) . "%",
                "isPositivePercentage" => (mt_rand(1, 2) == 1),
                "isValuePercentage" => false
            ];
        });
        return $cards->toArray();
    }
}
