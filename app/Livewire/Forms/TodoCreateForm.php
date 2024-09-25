<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TodoCreateForm extends Form
{
    #[Validate]
    public $title;

    public function rules()
    {
        return [
            'title' => ['required','min:3','max:20'],
        ];
    }
}
