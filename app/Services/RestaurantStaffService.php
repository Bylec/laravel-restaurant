<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Support\Collection;

class RestaurantStaffService
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function attachEmployees(Restaurant $restaurant, array $employeesIds): Collection
    {
        $employees = $this->employeeRepository->getManyByIds($employeesIds);

        $employeesToAttach = $employees->filter(function ($employee) use ($restaurant) {
            return $employee->canWorkInRestaurant($restaurant);
        })
        ->take($restaurant->numberOfSpotsLeft());

        if ($employeesToAttach->isNotEmpty()) {
            $restaurant->employees()->attach(
                $employeesToAttach
            );
        }

        return $employeesToAttach;
    }

    public function detachEmployees(Restaurant $restaurant, array $employeesIds): bool
    {
        return $restaurant->employees()->detach($employeesIds);
    }
}
