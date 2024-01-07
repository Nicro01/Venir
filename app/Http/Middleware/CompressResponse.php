<?php

namespace App\Http\Middleware;

use Closure;

class CompressResponse
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $buffer = $response->getContent();
        $buffer = preg_replace('/\s+/', ' ', $buffer);
        $buffer = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $buffer);

        $response->setContent($buffer);

        return $response;
    }
}
