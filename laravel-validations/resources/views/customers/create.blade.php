@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Create Customer</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @include('customers._form', ['buttonLabel' => 'Create'])
        </form>
    </div>
@endsection
