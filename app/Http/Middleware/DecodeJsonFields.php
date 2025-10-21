<?php

namespace App\Http\Middleware;

use Closure;

class DecodeJsonFields
{
    /**
     * Liste des champs JSON à décoder avant sauvegarde via Laravel Voyager.
     */
    protected $jsonFields = [
        'quantity_per_size',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();

        foreach ($this->jsonFields as $field) {
            if (array_key_exists($field, $input) && $input[$field] !== null) {
                // Si c’est une chaîne JSON valide, on décode
                if (is_string($input[$field]) && $this->isJson($input[$field])) {
                    $input[$field] = json_decode($input[$field], true);
                }
            }
        }

        $request->merge($input);

        return $next($request);
    }

    private function isJson($string)
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
