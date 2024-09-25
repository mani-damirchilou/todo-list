<?php

use App\Livewire\Forms\TodoCreateForm;
use App\Models\Todo;
use Artesaos\SEOTools\Facades\SEOTools;
use function Livewire\Volt\{layout, mount, state, usesPagination, with, form};

layout('layouts.base');

usesPagination();

mount(function () {
    SEOTools::setTitle('لیست من');
});

form(TodoCreateForm::class);

with(fn() => [
    'todos' => auth()->user()->todos()->orderBy('created_at','desc')->simplePaginate(5)
]);

$create = function () {
    $this->form->validate();
    auth()->user()->todos()->create($this->form->only('title'));
    $this->form->reset();
};

$complete = function (Todo $todo){
    $todo->update([
        'completed' => !$todo->completed
    ]);
};

$delete = function (Todo $todo){
    abort_if($todo->user_id !== auth()->id(),403);
    $todo->delete();
}

?>

<div>
    <x-card class="bg-base-200">
        <x-form wire:submit="create">
            <div class="flex gap-2">
                <x-input wire:model.blur="form.title" first-error-only
                         :placeholder="__('validation.attributes.title').'...'"/>
                <x-button type="submit" spinner="create" class="bg-base-300 btn-ghost text-blue-600" icon="o-plus"/>
            </div>
        </x-form>
        <x-hr/>
        @foreach($todos as $todo)
            <x-list-item :item="$todo">
                <x-slot:avatar>
                    <x-checkbox :checked="boolval($todo->completed)" wire:change="complete({{$todo}})"/>
                </x-slot:avatar>
                <x-slot:value @class(['line-through' => $todo->completed])>
                    {{$todo->title}}
                </x-slot:value>
                <x-slot:actions>
                    <x-button wire:click="delete({{$todo}})" icon="o-trash" class="bg-base-300 text-error btn-ghost"/>
                </x-slot:actions>
            </x-list-item>
        @endforeach
        @if($todos->hasPages())
            <x-hr/>
        @endif
        {{$todos->links()}}
    </x-card>
</div>
