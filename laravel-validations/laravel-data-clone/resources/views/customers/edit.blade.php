@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Edit Customer #{{ $customer->id }}</h1>

        <form action="{{ route('customers.update', $customer) }}" method="POST">
            @method('PUT')
            @include('customers._form', ['buttonLabel' => 'Update'])
        </form>
    </div>
@endsection
