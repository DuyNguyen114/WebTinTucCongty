<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;
use App\Events\ViewNew;

class SbViewNew
{
    public $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        //
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ViewNew $event)
    {
        //
        if (!$this->isPostViewed($event->new))
	    {
	        $event->new->increment('views');
	        $this->storePost($event->new);
	    }
    }
    private function isPostViewed($new)
	{
	    $viewed = $this->session->get('viewed_posts', []);

	    return array_key_exists($new->id, $viewed);
	}

	private function storePost($new)
	{
	    $key = 'viewed_posts.' . $new->id;

	    $this->session->put($key, time());
	}
}
