<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Vite;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        $ziggy = array_merge(
            (new Ziggy(url: $request->url()))->toArray(),
            ['location' => $request->url()]
        );

        return array_merge(parent::share($request), [
            'ziggy' => app()->isProduction() ? Arr::only($ziggy, 'url') : $ziggy
        ]);
    }
}
