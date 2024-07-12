@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Pegawai</h1>

    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>
        <div class="form-group">
            <label for="position">Jabatan</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" required>
        </div>
        <div class="form-group">
            <label for="hire_date">Tanggal Bergabung</label>
            <input type="text" class="form-control" id="hire_date" name="hire_date" value="{{ $employee->hire_date }}" required>
        </div>
        <div class="form-group">
            <label for="salary">Gaji</label>
            <input type="text" class="form-control" id="salary" name="salary" value="{{ $employee->salary }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
