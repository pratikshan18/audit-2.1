<?php
// app/Http/Middleware/EnsureFrontendRequestsAreStateful.php
namespace App\Http\Middleware;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful as Middleware;

class EnsureFrontendRequestsAreStateful extends Middleware {}
