@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Edit Invoice #{{ $invoice->id }}</h1>

        <form action="{{ route('invoices.update', $invoice) }}" method="POST">
            @method('PUT')
            @include('invoices._form', ['buttonLabel' => 'Update'])
        </form>
    </div>
@endsection
