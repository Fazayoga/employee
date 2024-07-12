@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><a href="{{ route('employees.index') }}">Data Pegawai</a></h1>

    <!-- Form for searching and sorting -->
    <form method="GET" action="{{ route('employees.index') }}" class="mb-4 form-inline">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari..." value="{{ request('search') }}">
        <select name="sort_by" class="form-control mr-2">
            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama</option>
            <option value="position" {{ request('sort_by') == 'position' ? 'selected' : '' }}>Jabatan</option>
            <option value="hire_date" {{ request('sort_by') == 'hire_date' ? 'selected' : '' }}>Tanggal Bergabung</option>
            <option value="salary" {{ request('sort_by') == 'salary' ? 'selected' : '' }}>Gaji</option>
        </select>
        <select name="order" class="form-control mr-2">
            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Link to create new employee -->
    <a href="{{ route('employees.create') }}" class="btn btn-success mb-4">Tambah Pegawai</a>

    <!-- Table to display employees -->
    <table id="employee-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tanggal Bergabung</th>
                <th>Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through employees and display each row -->
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->hire_date }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Delete form -->
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    {{-- {{ $employees->links() }} --}}

</div>
@endsection
