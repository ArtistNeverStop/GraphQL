<?php

namespace App\Traits\Support;

trait PropertyArrayable
{
    /**
     * Return an array of all public properties.
     *
     * @return array
     */
    public function toArray() : array
    {
        $public_properties = get_object_vars($this);
        $public_methods = [];
        foreach (get_object_vars($this) as $method) {
            $public_methods[$method] = function () {
                return call_user_method($method, $this, func_get_args());
            };
        }
        dd($public_methods, $public_properties);
        return [];
    }
}
