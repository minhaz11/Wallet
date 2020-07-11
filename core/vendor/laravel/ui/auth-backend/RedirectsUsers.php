<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Support\Facades\Session;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        // Session::flash('success','Password has been reset');

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home'; 
    }
}
