<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BaseApiController extends Controller
{
    /**
     * Format Send Response Success
     * @param $result
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message = '')
    {
        $response = [
            'success' => true,
            'data'    => $result,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, 200);
    }

    /**
     * Format Send Response Error
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message, $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * Format Send Response Validator
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendValidator($validator)
    {
        $response = [
            'success'   => false,
            'validator' => $validator,
        ];

        return response()->json($response, 422);
    }

    /**
     * Format Send Response Pagination
     * @param $result
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPaginationResponse($result, $message = '')
    {
        $result     = collect($result);
        $data       = $result->get('data');
        $pagination = $result->forget('data');
        $pagination = $pagination->forget('links');

        $response = [
            'success'    => true,
            'data'       => $data,
            'pagination' => $pagination,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, 200);
    }

    /**
     * Logic pagination array response
     * @param $result
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPaginationArrayResponse($result, $message = '')
    {
        $paged   = request()->get('page', 1);
        $perPage = request()->get('per_page', config('generate.per_page_default'));

        if (!is_numeric($paged)) $paged = 1;
        if (!is_numeric($perPage)) $perPage = config('generate.per_page_default');

        $result    = collect($result);
        $paginator = new LengthAwarePaginator(
            $result->forPage($paged, $perPage),
            collect($result)->count(),
            $perPage,
            $paged,
            [
                'path'     => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        return $this->sendPaginationResponse($paginator, $message);
    }
}
