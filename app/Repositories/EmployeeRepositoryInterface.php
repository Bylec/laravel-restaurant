<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Support\Collection;

interface EmployeeRepositoryInterface
{
    public function getManyByIds(array $employeeIds): Collection;
    public function create(array $data): Employee;
    public function update(Employee $employee, array $data): bool;
    public function delete(Employee $employee): bool;
}
