@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-box">
        <div class="row">
            <div class="col">
                <h3>Transfer Money</h3>
                <hr>
                <form method="POST" action="{{ route('transfer') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" required>
                        @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mx-1">
                        <button type="submit" class="btn btn-primary btn-block">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection