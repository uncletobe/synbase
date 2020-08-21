<?php


namespace App\Http\Guards;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;

class XwsseGuard implements Guard
{
    private $user = null;
    private $provider;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    public function login(Authenticatable $xwsse)
    {
        session()->put('user', $xwsse->getUser());
        session()->put('token', $xwsse->getToken());
        session()->put('role', $xwsse->getRole());
    }

    public function logout()
    {
        session()->flush();
    }

    public function token()
    {
        return session()->get("token");
    }

    public function role()
    {
        return session()->get("role");
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        $av_roles = \Config::get("roles.available");
        return session()->has("token")
            && in_array($this->role(), $av_roles);
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return session()->get("user");
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id()
    {
        return $this->user();
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
    }

    /**
     * Set the current user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }
}