<?php

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Session\Store;
use Auth;
use Session;
 
class SessionExpired {
    protected $session;
    protected $timeout; 
     
    public function __construct(Store $session){
        $this->session = $session;
        $this->timeout = config("session.idle_period_session_timeout"); // 15 default minutes
    }

    public function handle($request, Closure $next){
        $un_authenticated_urls = ['logout', 'register', 'forgot', '/'];
        $isLoggedIn = !in_array($request->path(), $un_authenticated_urls);
        if(! session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : '/');
            auth()->logout();
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }
}
