<?php

namespace App\Enums;

use App\Traits\enumHasOptionsArray;

enum TruckSize: String{
    use enumHasOptionsArray;

    case NoTruck = "No truck";
    case NineFoot = "9 ft cargo van";
    case FifteenFoot = "15 ft truck";
    case TwentyFoot = "20 ft truck";
    case TwentySixFoot = "26 ft truck";
}