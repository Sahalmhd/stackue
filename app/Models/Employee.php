<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
        use HasFactory;

    protected $fillable = [
        'employee_govt_id',
        'first_name',
        'last_name',
        'email',
        'department_id',
        'hire_date',
        'status',
    ];
    protected $casts = ['hire_date' => 'date'];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function getFullNameAttribute() {
    return $this->first_name . ' ' . $this->last_name;
}


    
}
