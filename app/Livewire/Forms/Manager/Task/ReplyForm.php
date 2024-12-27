<?php

namespace App\Livewire\Forms\Manager\Task;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReplyForm extends Form
{
    #[Validate('required|max:255')]
    public $description;
    public ?Task $task;

    public function setTask(Task $task)
    {
        $this->task = $task;
    }

    public function create()
    {
        $reply = $this->task->replies()->create(
            [
                'description' => $this->description,
                'manager_id' => auth('manager')->id(),
            ]
        );
        $this->reset('description');
        return $reply;
    }
}
