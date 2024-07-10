<?php

namespace App\Traits;

trait enumHasOptionsArray {
    public static function toOptionsArray(bool $capitalize = false, array $except = []): array
    {
        foreach(self::cases() as $case) {
            if(in_array($case, $except))
            {
                continue;
            }

            if($capitalize)
            {
                $array[$case->value] = ucfirst($case->value);
                continue;
            }

            $array[$case->value] = $case->value;
        }

        return $array;
    }
}