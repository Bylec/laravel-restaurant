<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandleRestaurantEmployeesRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Restaurant;
use App\Services\RestaurantStaffService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class RestaurantStaffController
{
    private RestaurantStaffService $restaurantStaffService;

    public function __construct(RestaurantStaffService $restaurantStaffService)
    {
        $this->restaurantStaffService = $restaurantStaffService;
    }

    public function attachEmployees(HandleRestaurantEmployeesRequest $request, Restaurant $restaurant)
    {
        try {
            return EmployeeResource::collection($this->restaurantStaffService->attachEmployees($restaurant, $request->get('employees')));
        } catch (Exception $exception) {
            \Log::error($exception->getMessage(), ['exception' => $exception]);
            return response()->json([
                'data' => 'Unable to attach Employees'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function detachEmployees(HandleRestaurantEmployeesRequest $request, Restaurant $restaurant)
    {
        try {
            return response()->json([
                'data' => $this->restaurantStaffService->detachEmployees($restaurant, $request->get('employees'))
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'data' => 'Unable to detach Employees'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
