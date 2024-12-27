<?php

namespace App\Models;

use App\Enums\StatusColorEnum;
use App\Enums\StatusEnum;
use App\Traits\WithStringFromGenericHuman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeTrainingRegistration extends Model
{
    use HasFactory, SoftDeletes;
    use WithStringFromGenericHuman;

    protected $table = 'employee_training_registrations';
    protected $fillable = ['employee_id', 'program_id', 'registration_date', 'status'];


    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'training_id', 'id');
    }

    public function TrainingProgram()
    {
        return $this->belongsTo(TrainingProgram::class, 'program_id', 'id');
    }

    public function getTrainingProgramNameAttribute()
    {
        return $this->getStringFromGenericHuman('TrainingProgram', 'name');
    }

    public function getStatusChangedAttribute()
    {
        $status = [
            StatusEnum::COMPLETED->value,
            StatusEnum::CANCELLED->value
        ];
        if (in_array($this->status, $status)) {
            return false;
        }

        return true;
    }


    public function completed()
    {
        $this->status = StatusEnum::COMPLETED;
        return ($this->save());
    }

    public function cancel()
    {
        $this->status = StatusEnum::CANCELLED;
        return ($this->save());
    }
}
