<?php


namespace App\Traits\Local;

use App\Models\Local\Employee;
use App\Models\Footprints\FootprintsEmployee;

trait AddEmployee
{
    protected function add(FootprintsEmployee $employee)
    {
        return Employee::create([
            'id' => $employee->RID,
            'footprints_user_id' => $employee->RID_USUARIO,
            'state' => $employee->ACTIVO,
            'charge' => $employee->CAMPO1,
            'created_at' => $employee->FH_INSERT
        ]);
    }
}
