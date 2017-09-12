<?php

namespace App;

class Grade
{
    /**
     * @param int $grade
     *
     * @return int[]
     */
    public static function getAgeRange($grade)
    {
        return [$grade + 5, $grade + 6];
    }
}
