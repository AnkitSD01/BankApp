@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-box">
     
        <table class="table table-light">
        <h5>Statement of Account<h5>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Details</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                use Illuminate\Pagination\LengthAwarePaginator;
                use Illuminate\Support\Collection;

                $perPage = 5;
                $currentPage = LengthAwarePaginator::resolveCurrentPage() ?: 1;
                $items = $statement->transactions->reverse();


                $currentPageItems = new Collection(array_slice($items->all(), ($currentPage - 1) * $perPage, $perPage));

                $transactions = new LengthAwarePaginator($currentPageItems, $items->count(), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
                ]);
                $balance = $statement->balance ?? 0;
                @endphp

                @foreach($transactions as $entry)
               
                <tr>
                    <td>{{ date('M d, Y h:i A', strtotime($entry['created_at'])) }}</td>
                    <td>{{ $entry['type'] }}</td>
                    <td>{{ $entry['amount'] }}</td>
                    <td>{{ $entry->meta['description'] ?? '' }}</td>
                    <td>{{ $balance }}</td>
                </tr>
                @php
                $amount = $entry['amount'];
                if($entry['type']=="withdraw"){
                    $amount = $entry['amount']*-1;
                }
                $balance += $amount;
                @endphp
                @endforeach
            </tbody>
        </table>

        {{ $transactions->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection