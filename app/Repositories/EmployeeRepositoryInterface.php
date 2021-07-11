<?php

namespace App\Repositories;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function create(array $data): Employee;
    public function update(Employee $employee, array $data): bool;
    public function delete(Employee $employee): bool;
}
