@extends('app')
@section('content')
<div class="h-screen flex flex-col justify-center items-center">
    {{$slot}}
</div>
@endsection
