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
                $timeLimit = Carbon::now()->subHours(12);
                $classDateTime = Carbon::parse($schedule->date)->setTimeFrom($schedule->time);

                if ($classDateTime->lessThanOrEqualTo($timeLimit)) {
                    $memberPlan = $schedule->memberPlan;

                    if ($memberPlan->last_deducted_at !== Carbon::today()->toDateString()) {
                        $memberPlan->update([
                            'remaining_session' => $memberPlan->remaining_session - 1,
                            'last_deducted_at' => Carbon::today()->toDateString()
                        ]);
                    }
                }
            }
        }

        return $next($request);
    }
}
