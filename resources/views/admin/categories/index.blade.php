@extends('layouts.admin')

@section('admin-title', 'Categories')

@section('admin-content')

<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add New Category</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="max-width: 50px; max-height: 50px; border-radius: 5px;">
                        @else
                            <span style="color: var(--text-muted);">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td>{{ $category->products()->count() }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure? This will also delete all products in this category.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">No categories yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
