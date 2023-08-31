@extends('layouts.invoice')

@section('pdf-view')
    <main class="invoice-block">
        <h1 class="heading-1">Bijoy Dibos Hall</h1>
        <h2 class="heading-2">Invoice</h2>

        <table class="table">
            <thead class="table-header">
            <tr>
                <th>Invoice ID</th>
                <th>User Name</th>
                <th>Transactions</th>
                <th>Comment</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody class="table-body">
            <tr>
                <td class="border-right">#{{$invoice->uuid}}</td>
                <td class="border-right">{{$invoice->user->name}}</td>
                <td class="border-right">
                    <ul class="trans-list">
                        @foreach(collect(json_decode($invoice->transactions)) as $transaction)
                            <li class="trans-item">{{$transaction->name}} - {{$transaction->amount}}
                                - {{$transaction->reference}}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="border-right">{{$invoice->comment}}</td>
                <td class="">{{$invoice->created_at}}</td>
            </tr>
            </tbody>
            <tfoot class="table-footer">
            <tr>
                <td colspan="1">Total</td>
                <td colspan="1">:</td>
                <td colspan="3">{{$invoice->total}}</td>
            </tr>
            </tfoot>
        </table>

        <h3 class="heading-3">Thank you for staying with us.</h3>

        <table>
            <thead>
            <tr>
                <th class="text-left">User Signature</th>
                <th></th>
                <th></th>
                <th class="text-right">Provost Signature</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" class="text-left">-----------------</td>
                <td colspan="2" class="text-right">-----------------</td>
            </tr>
            </tbody>
        </table>
    </main>
@endsection


@section('styles')
    <style>
        .invoice-block {
            display: flex;
            flex-direction: column;
        }

        .heading-1 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .heading-2 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .heading-3 {
            text-align: center;
            margin-top: 1rem;
        }

        .border-right {
            border-right: 1px solid #ddd;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #ddd;
        }

        .table-header {
            background-color: black;
            color: white;
        }

        .table-body {
            background-color: #fff;
        }

        .table-footer {
            background-color: black;
            color: white;
        }

        th {
            padding: 10px;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        td {
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .trans-list {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .trans-list > .trans-item {
            list-style: none;
            margin-bottom: 0.5rem;
        }

        .invoice-footer {
            margin-top: 1rem;
        }

        .invoice-footer > .signature-section {
            display: flex;
            justify-content: space-around;
            list-style-type: none;
        }
    </style>
@endsection
