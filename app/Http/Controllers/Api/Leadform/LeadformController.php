<?php

namespace App\Http\Controllers\Api\Leadform;

use App\Http\Controllers\Api\BaseApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LeadformController extends BaseApiController
{
    public $languageCode;
    public $locationCode;

    public function __construct(
        Request $request
    ) {
        $this->languageCode         = $request->header('language-code');
        $this->locationCode         = $request->header('location-code');
    }

    public function create(Request $request)
    {
        try {
            dd($request->all());
            $validator = Validator::make($request->all(), [
                'full_name'                    => ['required', "regex:" . config('generate.regex_validate_rule.full_name'), 'max:255'],
                'email'                        => ['required', 'email:filter', 'max:255'],
                'phone_number'                 => ['required', "regex:" . config('generate.regex_validate_rule.phone_number')],
                'files'                        => ['nullable', 'array', "1024"],
                'files.*'                      => ['nullable',
                    function ($attribute, $value, $fail) {
                        $extension = strtolower(pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION));
                    }
                ],
            ]);

            if ($validator->fails()) return $this->sendValidator($validator->errors()->toArray());
            $dataContactUs   = $validator->validated();

            return $this->sendResponse($dataContactUs);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return $this->sendError(__('curd.create_failed'), 500);
        }
    }
}
