@extends('layouts.app')

@section('content')

    <main class="container">
        <h1 class="text-2xl text-center my-10">Invoice listing page</h1>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                <tr>
                    <th>Invoice Id</th>
                    <th>Transactions</th>
                    <th>Total</th>
                    <th>Comment</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->uuid }}</td>
                        <td>
                            <ul>
                                @foreach(collect(json_decode($invoice->transactions)) as $transaction)
                                    <li>{{$transaction->name}} - {{$transaction->amount}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $invoice->total }}</td>
                        <td>{{ $invoice->comment }}</td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>
                            <a href="{{ route('invoice.view', $invoice->uuid) }}"
                               class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $invoices->links()}}
    </main>

@endsection
