<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate]
    public $name,$email,$password,$password_confirmation;

    public function rules()
    {
        return [
            'name' => ['required','min:3','max:50','string'],
            'email' => ['required','email','unique:users','max:255','string'],
            'password' => ['required','min:8', 'confirmed','string'],
        ];
    }
}
