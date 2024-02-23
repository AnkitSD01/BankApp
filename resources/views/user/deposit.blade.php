@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-box">
        <div class="row">
            <div class="col">
                <big>Deposit Money</big>
                <hr>
                <form method="POST" action="{{ route('deposit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" required>
                        @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mx-1">
                        <button type="submit" class="btn btn-primary btn-block">Deposit</button>
                        <div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection