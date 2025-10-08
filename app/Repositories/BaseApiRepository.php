<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BaseApiRepository
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
        $paged   = (int) request()->get('page', 1);
        $perPage = request()->get('per_page', 10);

        if (!is_numeric($paged)) $paged = 1;
        if (!is_numeric($perPage)) $perPage = config('generate.per_page_default');

        $result    = collect($result);
        $paginator = new LengthAwarePaginator(
            array_values($result->forPage($paged, $perPage)->toArray()),
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

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, [
            'path'     => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }
}
