#!/usr/bin/env php
<?php

use Sabre\VObject;

if ($argc<2) {
    $cmd = $argv[0];
    fwrite(STDERR, <<<HI
Fruux test data generator

This script generates a lot of test data. This is used for profiling and stuff.
Currently it just generates events in a single calendar.

The iCalendar output goes to stdout. Other messages to stderr.

{$cmd} [events]


HI
    );
    die();
}

$events = 100;

if (isset($argv[1])) $events = (int)$argv[1];

include __DIR__ . '/../vendor/autoload.php';

fwrite(STDERR, "Generating " . $events . " events\n");

$currentDate = new DateTime('-' . round($events/2) .  ' days');

$calendar = VObject\Component::create('VCALENDAR');
$calendar->version = '2.0';
$calendar->calscale = 'GREGORIAN';

$ii=0;

while($ii < $events) {

    $ii++;

    $event = VObject\Component::create('VEVENT');
    $event->DTSTART = 'bla';
    $event->SUMMARY = 'Event #' . $ii;
    $event->UID = md5(microtime(true));

    $doctorRandom = mt_rand(1,1000);

    switch($doctorRandom) {
        // All-day event
        case 1 : 
            $event->DTEND = 'bla';
            $dtStart = clone $currentDate;
            $dtEnd = clone $currentDate;
            $dtEnd->modify('+' . mt_rand(1,3) . ' days');
            $event->DTSTART->setDateTime($dtStart, VObject\Property\DateTime::DATE);
            $event->DTEND->setDateTime($dtEnd, VObject\Property\DateTime::DATE);
            break;
        case 2 :
            $event->RRULE = 'FREQ=DAILY;COUNT=' . mt_rand(1,10);
            // No break intentional
        default :
            $dtStart = clone $currentDate;
            $dtStart->setTime(mt_rand(1,23), mt_rand(0,59), mt_rand(0,59));
            $event->DTSTART->setDateTime($dtStart, VObject\Property\DateTime::UTC);
            $event->DURATION = 'PT'.mt_rand(1,3).'H';
            break;

    }
    
    $calendar->add($event);
    $currentDate->modify('+ ' . mt_rand(0,3) . ' days');

}
fwrite(STDERR, "Validating\n");

$result = $calendar->validate();
if ($result) {
    fwrite(STDERR, "Errors!\n");
    fwrite(STDERR, print_r($result,true));
    die(-1);
}

fwrite(STDERR, "Serializing this beast\n");

echo $calendar->serialize();

fwrite(STDERR, "done.\n");

