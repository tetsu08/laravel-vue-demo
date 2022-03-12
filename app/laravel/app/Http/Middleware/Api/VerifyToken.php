<?php
declare(strict_types=1);

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Kreait\Firebase\Factory;

class VerifyToken
{
    /**
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = (new Factory)->withProjectId(Config::get('firebase.project_id'))->createAuth();
        try {
            $auth->verifyIdToken($request->bearerToken());
        } catch (\Exception $exception) {
            throw new AuthorizationException(null, null, $exception);
        }
        return $next($request);
    }
}
