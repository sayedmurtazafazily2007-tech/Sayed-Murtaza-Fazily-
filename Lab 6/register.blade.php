<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | IT Student Portal</title>
</head>
<body>
    <h1>Create an account</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <label for="name">Full name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required>

        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>

        <label for="password">Password (at least 8 characters)</label>
        <input id="password" name="password" type="password" required>

        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required>

        <button type="submit">Register</button>
    </form>

    <a href="{{ route('login') }}">Already have an account?</a>
</body>
</html>