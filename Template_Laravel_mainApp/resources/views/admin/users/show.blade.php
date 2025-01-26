@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $user->name }}</h1>

    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d-m-Y H:i:s') }}</p>

    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>
@endsection
