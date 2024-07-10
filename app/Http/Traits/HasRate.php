<?php 
namespace App\Http\Traits;

use App\Enums\TruckSize;
use Illuminate\Support\Carbon;

trait HasRate
{
    public function checkRate(int $movers, int $hours, string $truck, int|string $mileage)
    {
        $hourly = match($hours){
            1 => 75,
            2 => 55,
            default => 50
        };

        if($mileage > 40)
        {
            $mileage = 40;
        }

        switch($truck){
            case(TruckSize::NoTruck->value):
                return (($movers * $hours) * $hourly) + ((int)$mileage * 1.50);
                break;
            case(TruckSize::NineFoot->value):
                return (($movers * $hours) * 55) + ((int)$mileage * 3.25) + 120;
                break;
            case(TruckSize::FifteenFoot->value):
                return (($movers * $hours) * 55) + ((int)$mileage * 4.50) + 180;
                break;
            case(TruckSize::TwentyFoot->value):
                return (($movers * $hours) * 55) + ((int)$mileage * 4.50) + 200;
                break;
            case(TruckSize::TwentySixFoot->value):
                return (($movers * $hours) * 55) + ((int)$mileage * 4.50) + 220;
                break;
        }
    }

    public function getDiscount(string $discount)
    {
        return match($discount)
        {
            "MOVEWITHCADDY2023" => 5,
            "CADDY10MOVE2023" => 10,
            "MYBESTMOVEEVER15" => 15,
            "CADDYMOVEME20" => 20,
            "25CADDYMOVINGSPECIAL" => 25,
            default => 0
        };
    }

    public function getCharge(int $rate, int $hours)
    {
        return $rate * $hours;
    }

    public function getSurcharge(string $date, string $truck)
    {
        $date = Carbon::createFromFormat('m-d-Y', $date)->setTimezone("America/Chicago");

        $value = 10;

        if($truck != TruckSize::NoTruck->value)
        {
            $value = 15;
        }

        if($date->isToday() || $date->isTomorrow())
        {
            return $value;
        }

        return 0;
    }
}
