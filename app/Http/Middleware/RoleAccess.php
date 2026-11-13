<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$features): mixed
    {
        $user = $request->user();

        if (! $user) {
            abort(403, 'Akses ditolak. Silakan login terlebih dahulu.');
        }

        $feature = $features[0] ?? null;

        if ($feature === null) {
            abort(403, 'Fitur tidak ditemukan dalam konfigurasi akses.');
        }

        if (! $user->canAccessFeature($feature)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses fitur ini.');
        }

        return $next($request);
    }
}
