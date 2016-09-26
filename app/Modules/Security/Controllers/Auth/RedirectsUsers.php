<?php

namespace App\Modules\Security\Controllers\Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */

    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    public function redirectLoginPath()
    {
        return '/login';
    }


}
