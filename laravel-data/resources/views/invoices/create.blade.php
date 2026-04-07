@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Create Invoice</h1>

        <form action="{{ route('invoices.store') }}" method="POST">
            @include('invoices._form', ['buttonLabel' => 'Create'])
        </form>
    </div>
@endsection
