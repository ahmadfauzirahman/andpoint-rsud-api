<?php

namespace app\components;


class GoogleCalendar
{
    public $api_key = 'AIzaSyCP682qZ9mv_zharuEg35BeekJFekW3nTg';
    public $calendar_id = 'indonesian@holiday.calendar.google.com';  // Google Holiday Indonesia

    function getHolidayThisMonth($year, $month)
    {
        // hari pertama setiap bulan
        $first_day = mktime(0, 0, 0, intval($month), 1, intval($year));
        // hari terakhir setiap bulan
        $last_day = strtotime('-1 day', mktime(0, 0, 0, intval($month) + 1, 1, intval($year)));

        $holidays_url = sprintf(
            'https://www.googleapis.com/calendar/v3/calendars/%s/events?' .
                'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
            $this->calendar_id,
            $this->api_key,
            date('Y-m-d', $first_day) . 'T00:00:00Z',  // timeMin
            date('Y-m-d', $last_day) . 'T00:00:00Z',   // timeMax
            31            // maxResults
        );

        if ($results = file_get_contents($holidays_url)) {
            $results = json_decode($results);
            $holidays = array();
            foreach ($results->items as $item) {
                $date = strtotime((string)$item->start->date);
                $title = (string)$item->summary;
                $holidays[date('Y-m-d', $date)] = $title;
            }
            ksort($holidays);
        }
        return $holidays;
    }
}
