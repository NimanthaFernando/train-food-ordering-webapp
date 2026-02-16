<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body {
    position: relative;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('images/login.jpeg') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    filter: blur(6px); /* You can adjust the blur level */
    z-index: -1;
}
    .login-card {
      width: 320px;
      padding: 2rem;
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }
    .login-card h2 {
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .form-control {
      height: 38px;
      font-size: 0.9rem;
    }
    .btn-primary {
      width: 100%;
      padding: 0.5rem;
      font-size: 1rem;
    }
    .text-danger {
      font-size: 0.8rem;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>🧑‍💼 Admin Login</h2>

   <form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf

    <div class="mb-3">
        <input
            type="email"
            name="email"
            class="form-control"
            placeholder="Email address"
            value="{{ old('email') }}"
            required
            autofocus>
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"
            required>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input
            type="checkbox"
            name="remember"
            class="form-check-input"
            id="remember"
            {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Remember Me</label>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

  </div>
</body>
</html>
