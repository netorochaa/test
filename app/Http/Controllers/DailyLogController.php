<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailyLogStoreRequest;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DailyLogController extends Controller
{
    public function store(DailyLogStoreRequest $request)
    {
        DailyLog::create([
            'log' => $request->get('log'),
            'day' => $request->get('day') . " 00:00:00",
            'user_id' => Auth::user()->id
        ]);
    }

    public function update(DailyLog $dailylog)
    {
        $dailylog->update(request()->only('log'));

        return back();
    }

    public function destroy(DailyLog $dailylog)
    {
        abort_if(Auth::user()->id != $dailylog->user->id, Response::HTTP_FORBIDDEN, 'Você não esta autorizado');
        
        $dailylog->delete();

        return back();
    }
}
