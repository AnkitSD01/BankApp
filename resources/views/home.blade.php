@extends('layouts.app')

@section('content')

<div class="customcontainer">
    <div class="content-box">

        <ul class="list-group list-group-flush">
            <li class="list-group-item font-weight-bold"><big> Welcome {{$userData->name ?? ""}}</big></li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col">YOUR ID</div>
                    <div class="col font-weight-bold ml-4">{{$userData->email ?? ""}}</div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col">YOUR BALANCE</div>
                    <div class="col font-weight-bold">{{$userData->balance ?? ""}} INR</div>
                </div>
            </li>
        </ul>
    </div>
</div>



@endsection