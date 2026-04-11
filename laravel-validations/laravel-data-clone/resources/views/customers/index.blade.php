@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="toolbar">
            <h1>Customers</h1>
            <a class="btn btn-primary" href="{{ route('customers.create') }}">Add Customer</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Postal Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->type }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->state }}</td>
                        <td>{{ $customer->postal_code }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer) }}">Edit</a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline-block; margin-left: 8px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this customer?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrap">{{ $customers->links() }}</div>
    </div>
@endsection
