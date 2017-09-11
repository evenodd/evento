<?php

namespace App\Http\Middleware;

use Closure;

class FormatDateTimes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('start-datetime'))
            $request->merge(['start-datetime' => $this->htmlDatetimeLocalToTimestamp($request->input('start-datetime'))]);
        if ($request->has('end-datetime'))
            $request->merge(['end-datetime' => $this->htmlDatetimeLocalToTimestamp($request->input('end-datetime'))]);
        if ($request->has('rsvp-datetime'))
            $request->merge(['rsvp-datetime' => $this->htmlDatetimeLocalToTimestamp($request->input('rsvp-datetime'))]);
        return $next($request);
    }

    private function htmlDatetimeLocalToTimestamp($datetime) {
        $date = \DateTime::createFromFormat('Y-m-d\TH:i', $datetime);
        return $date->format('Y-m-d H:i:s');

    }
}
