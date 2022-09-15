<?php

namespace App\Http\Middleware;

use App\Models\Service;
use Closure;
use Illuminate\Http\Request;
use App\Traits\ResponsableTrait;

class ValidateService
{
    use ResponsableTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $services = Service::where('id', $request->service_id)->first();

        if (!$services->is_available) {
            return $this->serviceUnavailableResponse("service temporary not available");
        }
        return $next($request);
    }
}
