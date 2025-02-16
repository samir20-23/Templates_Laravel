@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Item Management</h2>

    <form id="itemForm">
        <input type="text" id="name" name="name" placeholder="Enter Name">
        <button type="submit">Add</button>
    </form>

    <table border="1">
        <thead>
            <tr><th>Name</th><th>Actions</th></tr>
        </thead>
        <tbody id="itemTable">
            @foreach($items as $item)
                <tr id="row-{{ $item->id }}">
                    <td>{{ $item->name }}</td>
                    <td>
                        <button onclick="editItem({{ $item->id }}, '{{ $item->name }}')">Edit</button>
                        <button onclick="deleteItem({{ $item->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('itemForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let name = document.getElementById('name').value;
        fetch("{{ route('items.store') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
            body: JSON.stringify({ name })
        })
        .then(response => response.json())
        .then(item => {
            document.getElementById('itemTable').innerHTML += 
                `<tr id="row-${item.id}">
                    <td>${item.name}</td>
                    <td>
                        <button onclick="editItem(${item.id}, '${item.name}')">Edit</button>
                        <button onclick="deleteItem(${item.id})">Delete</button>
                    </td>
                </tr>`;
        });
    });

    function editItem(id, oldName) {
        let newName = prompt("Edit Name:", oldName);
        if (!newName) return;

        fetch(`/items/${id}`, {
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
            body: JSON.stringify({ name: newName })
        })
        .then(response => response.json())
        .then(item => {
            document.querySelector(`#row-${id} td:first-child`).textContent = item.name;
        });
    }

    function deleteItem(id) {
        fetch(`/items/${id}`, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        })
        .then(() => {
            document.getElementById(`row-${id}`).remove();
        });
    }
</script>
@endsection
