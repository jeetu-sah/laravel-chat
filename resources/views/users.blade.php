@extends('layouts.app')
@section('content')
    @if(Auth::check())
        <userlist-component></userlist-component>
    @else
    <div class="container">
        <h1>This is a demo of laravel chat application</h1>
    </div>
    @endif
@endsection
