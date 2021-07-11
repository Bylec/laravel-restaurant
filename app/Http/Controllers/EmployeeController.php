<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function fetch(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    public function create(CreateEmployeeRequest $request)
    {
        try {
            return new EmployeeResource(
                $this->employeeRepository->create($request->validated())
            );
        } catch (Exception $exception) {
            return response()->json([
                'data' => 'Unable to create user.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $this->employeeRepository->update($employee, $request->validated());
            return new EmployeeResource($employee);
        } catch (Exception $exception) {
            return response()->json([
                'data' => 'Unable to update user.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Employee $employee)
    {
        return response()->json([
            'date' => $this->employeeRepository->delete($employee)
        ], Response::HTTP_OK);
    }
}
