<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Session\Store;

class Filter
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $new = $this->getViewedPosts();
        if (!is_null($new))
        {
            $new = $this->cleanExpiredViews($new);
            $this->storePosts($new);
        }
        return $next($request);
    }
    private function getViewedPosts()
    {
        return $this->session->get('viewed_posts', null);
    }

    private function cleanExpiredViews($new)
    {
        $time = time();

        // Let the views expire after one hour.
        $throttleTime = 10;

        return array_filter($new, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storePosts($new)
    {
        $this->session->put('viewed_posts', $new);
    }
}
