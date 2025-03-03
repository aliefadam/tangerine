<?php

namespace App\Http\Middleware;

use App\Models\MemberPlan;
use App\Models\Schedule;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateRemainingSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $schedules = Schedule::all();
        foreach ($schedules as $schedule) {
            if ($schedule) {
                $yesterday = Carbon::parse($schedule->date)->subDay();
                $today = Carbon::today();

                if ($yesterday->equalTo($today)) {
                    $memberPlan = $schedule->memberPlan;

                    if ($memberPlan->last_deducted_at !== $today->toDateString()) {
                        $memberPlan->update([
                            'remaining_session' => $memberPlan->remaining_session - 1,
                            'last_deducted_at' => $today->toDateString()
                        ]);
                    }
                }
            }
        }

        // exit;
        return $next($request);
    }
}
