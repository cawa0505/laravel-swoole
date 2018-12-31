<?php

namespace SwooleTW\Http\HotReload;

use Illuminate\Support\Carbon;

/**
 * Class FSEventParser
 */
class FSEventParser
{
    protected const REGEX = '/^([\S+]{3}\s+[\S+]{3}\s+[\d+]{2}\s+[\d+]{2}:[\d+]{2}:{0,2}:[\d+]{2}:{0,2}\s+[\d+]{0,4})\s+(\/[\S+]*)\s+([\S+*\s+]*)/mi';

    protected const DATE = 1;
    protected const PATH = 2;
    protected const EVENTS = 3;

    /**
     * @param string $event
     *
     * @return \SwooleTW\Http\HotReload\FSEvent
     */
    public static function toEvent(string $event): ?FSEvent
    {
        if (preg_match(static::REGEX, $event, $matches)) {
            $date = Carbon::parse($matches[static::DATE]);
            $path = $matches[static::PATH];
            $events = explode(' ', $matches[static::EVENTS]);

            return new FSEvent($date, $path, $events);
        }

        return null;
    }
}