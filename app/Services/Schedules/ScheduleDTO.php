<?php

namespace App\Services\Schedules;

class ScheduleDTO
{
    public function __construct(
        public array $weekly,   // {"1":"10:00-11:00", "3":"10:00-11:00" } monday, wednesday
                                // {"1":["10:00", "11:00"], ... , "3":["10:00", "11:00"]}
        public array $monthly // {"21": ["10:00", "11:00"], "25": ["12:00", "15:00"] }
    )
    {}

}
