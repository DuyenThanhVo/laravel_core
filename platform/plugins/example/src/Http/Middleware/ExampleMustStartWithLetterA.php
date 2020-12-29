<?php

namespace Scoris\Example\Http\Middleware;

use Closure;

class ExampleMustStartWithLetterA
{
    public function handle($request, Closure $next)
    {
        $example = $request->route('example');
        if ($example[0] !== 'a') {
            return redirect('/cannot-create-example');
        }

        return $next($request);
    }
}
