<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyLog extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'log',
        'day'
    ];

    public const VALIDATION_RULES = [
        'log' => 'required|not_in:SHIT',
        'day' => 'required|date'  
    ];

    /**
     * Get the user that owns the DailyLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fromToday()
    {
        return DailyLog::whereBetween('day', [date('Y-m-d') . " 00:00:01", date('Y-m-d') . " 23:59:59"]);
    }

    public function setAttributeDay()
    {
        return $this->attributes['day'] = Carbon::createFromFormat('Y-m-d', $this->attributes['day'])->format('Y-m-d');
    }
}
