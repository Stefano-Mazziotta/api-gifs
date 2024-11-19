<?php

namespace App\Modules\Log\Infrastructure;

use Closure;
use Illuminate\Http\Request;
use App\Modules\Log\Domain\Log;

class LogInteractionMiddleware
{
    const MAX_RESPONSE_BODY_LENGTH = 10000;

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $responseBody = $response->getContent();

        if (strlen($responseBody) > self::MAX_RESPONSE_BODY_LENGTH) {
            $responseBody = substr($responseBody, 0, self::MAX_RESPONSE_BODY_LENGTH);
        }

        Log::create([
            'user_id' => $request->user()->id ?? null,
            'service' => $request->path(),
            'request_body' => json_encode($request->all()),
            'http_code' => $response->getStatusCode(),
            'response_body' => $responseBody,
            'ip_address' => $request->ip(),
        ]);

        return $response;
    }
}
