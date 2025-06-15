<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeeId = $this->route('employee'); 

        return [
            'employee_govt_id' => [
                'required',
                'regex:/^3\d{8}5$/',
                'unique:employees,employee_govt_id,' . $employeeId
            ],
            'first_name'       => ['required'],
            'last_name'        => ['required'],
            'email'            => [
                'required',
                'email',
                'unique:employees,email,' . $employeeId
            ],
            'department_id'    => ['required', 'exists:departments,id'],
            'hire_date'        => ['required', 'date'],
            'status'           => ['required', 'in:active,inactive'],
        ];
    }
}
