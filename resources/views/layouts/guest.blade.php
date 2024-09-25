@extends('app')
@section('content')
    <div class="h-screen flex justify-center items-center">
            {{$slot}}
    </div>
@endsection
