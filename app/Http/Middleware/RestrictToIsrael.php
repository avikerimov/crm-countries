<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GeoIp2\Database\Reader;

class RestrictToIsrael
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* Bypass GeoIP lookup when running locally */
        if (app()->environment('local')) {
            return $next($request);
        }

        /* Get the IP address of the client */
        $ip = $request->ip();

        /* Manually IP (Not from Israel) */
        // $ip = '84.17.47.126';

        /* Load the GeoLite2 database */
        $database = new Reader(database_path('GeoLite2-Country.mmdb'));

        /* Perform IP address validation - Check if the IP address belongs to Israel */
        try {
            $record = $database->country($ip);
            $countryCode = $record->country->isoCode;

            if ($countryCode !== 'IL') {
                /* IP address is not from Israel, return a response or redirect */
                return response('Access Denied', 403);
            }
        } catch (\Exception $e) {
            /* Failed to determine the country */
            return response('Error', 500);
        }

        /* IP address is from Israel, allow the request to proceed */
        return $next($request);
    }
}
