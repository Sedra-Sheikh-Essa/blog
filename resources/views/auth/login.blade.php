@extends('layouts.app')
@section('title', 'login')
@section('content')
<div class="p-5 text-primary-emphasis vh-100" style="background-color:#724db8;">
        <h1 class="text-light">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="mt-5 pt-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fs-2 text-light">Email:</label>
                <input type="email" name="email" placeholder="Enter your Email" class="form-control"
                    id="exampleInputEmail1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label fs-3 text-light">Password:</label>
                <input type="password" name="password" placeholder="Enter your Password" class="form-control"
                    id="exampleInputPassword1">
            </div>
            <input type="submit" value="login" class="btn px-4 text-light" style="background-color:#b69fde;">
        </form>
    </div>
@endsection
