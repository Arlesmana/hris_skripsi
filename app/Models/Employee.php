<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'address',
        'birth_date',
        'hire_date',
        'department_id',
        'role_id',
        'status',
        'salary'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function attendances()
    {
        return $this->hasMany(attendance::class);
    }
    public function role()
    {
    return $this->belongsTo(Role::class);
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
