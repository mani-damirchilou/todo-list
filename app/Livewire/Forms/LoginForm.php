<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate]
    public $email,$password,$remember = false;

    public function rules()
    {
        return [
            'email' => ['required','email','exists:users','string'],
            'password' => ['required','string'],
            'remember' => ['required','boolean'],
        ];
    }
}
