<?php

namespace App\Http\Controllers;

use App\Models\MemberPlan;
use Illuminate\Http\Request;

class MemberPlanController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $memberPlan = MemberPlan::find($id);
        return response()->json($memberPlan);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
