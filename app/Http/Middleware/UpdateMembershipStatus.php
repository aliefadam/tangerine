<?php

namespace App\Http\Middleware;

use App\Models\MemberPlan;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateMembershipStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();

        $memberPlans = MemberPlan::all();
        foreach ($memberPlans as $memberPlan) {
            $expiredDateTime = $memberPlan->expired_date;

            $isExpired = $expiredDateTime < $now;
            $isOutOfSessions = $memberPlan->remaining_session <= 0;

            $status = ($isExpired || $isOutOfSessions) ? "inactive" : "active";

            $memberPlan->update([
                "status" => $status
            ]);
        }

        return $next($request);
    }
}
