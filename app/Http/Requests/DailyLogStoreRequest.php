<?php

namespace App\Http\Requests;

use App\Models\DailyLog;
use Illuminate\Foundation\Http\FormRequest;

class DailyLogStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @retu rn array
     */
    public function rules()
    {
        return  DailyLog::VALIDATION_RULES;
    }
}
