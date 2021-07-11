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

    /**
     * @OA\Get(
     *      path="/api/employees/{employee}",
     *      operationId="handleEmployee",
     *      tags={"Employee"},
     *      summary="Gets single employee",
     *      description="Gets single employee",
     *      @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *      ),
     *     )
     */
    public function fetch(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * @OA\Post(
     *      path="/api/employees",
     *      operationId="handleEmployee",
     *      tags={"Employee"},
     *      summary="Create single employee",
     *      description="Create single employee",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
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

    /**
     * @OA\Patch(
     *      path="/api/employees/{employee}",
     *      operationId="handleEmployee",
     *      tags={"Employee"},
     *      summary="Update single employee",
     *      description="Update single employee",
     *      @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
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

    /**
     * @OA\Delete(
     *      path="/api/employees/{employee}",
     *      operationId="handleEmployee",
     *      tags={"Employee"},
     *      summary="Deletes single employee",
     *      description="Deletes single employee",
     *      @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
    public function delete(Employee $employee)
    {
        return response()->json([
            'data' => $this->employeeRepository->delete($employee)
        ], Response::HTTP_OK);
    }
}
