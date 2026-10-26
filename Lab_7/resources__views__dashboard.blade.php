<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Course Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light" type="submit">Logout</button>
        </form>
    </div>
</nav>

<main class="container py-4">
    <h1 class="h3">Welcome, {{ auth()->user()->name }}!</h1>

    @if (session('success'))
        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    <section class="card shadow-sm my-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Register a Course</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input id="course_code" name="course_code" type="text"
                               class="form-control @error('course_code') is-invalid @enderror"
                               value="{{ old('course_code') }}" maxlength="20" required>
                        @error('course_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input id="course_name" name="course_name" type="text"
                               class="form-control @error('course_name') is-invalid @enderror"
                               value="{{ old('course_name') }}" maxlength="150" required>
                        @error('course_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="credit_hours" class="form-label">Credit Hours</label>
                        <input id="credit_hours" name="credit_hours" type="number"
                               class="form-control @error('credit_hours') is-invalid @enderror"
                               value="{{ old('credit_hours') }}" min="1" max="6" required>
                        @error('credit_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="semester" class="form-label">Semester</label>
                        <select id="semester" name="semester" required
                                class="form-select @error('semester') is-invalid @enderror">
                            <option value="">Select semester</option>
                            @foreach (['Spring 2026', 'Fall 2026'] as $term)
                                <option value="{{ $term }}" @selected(old('semester') == $term)>
                                    {{ $term }}
                                </option>
                            @endforeach
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Register Course</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="card shadow-sm">
        <div class="card-header">
            <h2 class="h5 mb-0">My Registered Courses ({{ $courses->count() }})</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Credits</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Registered On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>{{ $course->semester }}</td>
                                <td>{{ $course->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary">
                                    You have not registered any courses yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
</body>
</html>
