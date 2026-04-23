@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('title', 'Login')

@section('body')
<div class="login-wrapper">

    {{-- Background Blur Gradient --}}
    <div class="bg-animated"></div>

    {{-- Glass Card --}}
    <div class="login-glass">

        <div class="login-header">
            <div class="logo">
                <i class="fas fa-user-shield"></i>
            </div>
            <h2>Welcome Back</h2>
            <p>Masuk ke sistem manajemen</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="input-glass">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            {{-- Password --}}
            <div class="input-glass">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            {{-- Remember --}}
            <div class="login-options">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            {{-- Button --}}
            <button type="submit" class="btn-glass">
                Login
            </button>

            <div class="login-links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <i class="fas fa-key"></i> Lupa Password?
                    </a>
                @endif
            
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> Register Akun Baru
                    </a>
                @endif
            </div>

        </form>

    </div>
</div>
@stop

@section('css')
<style>

/* HAPUS BACKGROUND DEFAULT ADMINLTE */
body.login-page {
    background: transparent !important;
}

/* FULL BACKGROUND SAMA DENGAN LOGIN */
.login-wrapper {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #3a7d78, #1f3b57);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* OPTIONAL: biar lebih hidup */
.login-wrapper::before {
    content: '';
    position: absolute;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.15), transparent);
    animation: moveBg 10s linear infinite;
}

@keyframes moveBg {
    0% { transform: translate(0,0); }
    50% { transform: translate(-50px, -50px); }
    100% { transform: translate(0,0); }
}
/* ===== BACKGROUND ANIMASI ===== */
.login-wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
    background: #0f172a;
}

.bg-animated {
    position: absolute;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, #667eea, #764ba2, #6ee7b7, #60a5fa);
    animation: gradientMove 12s ease infinite;
    filter: blur(120px);
    opacity: 0.5;
}

@keyframes gradientMove {
    0% { transform: translate(-25%, -25%) rotate(0deg); }
    50% { transform: translate(-10%, -30%) rotate(180deg); }
    100% { transform: translate(-25%, -25%) rotate(360deg); }
}

/* ===== GLASS CARD ===== */
.login-glass {
    position: relative;
    width: 420px;
    padding: 40px;
    border-radius: 20px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);

    border: 1px solid rgba(255,255,255,0.15);
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);

    animation: fadeUp 0.8s ease;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== HEADER ===== */
.login-header {
    text-align: center;
    margin-bottom: 30px;
}

.logo {
    width: 70px;
    height: 70px;
    margin: auto;
    border-radius: 15px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.logo i {
    color: white;
    font-size: 28px;
}

.login-header h2 {
    color: white;
    font-weight: 700;
}

.login-header p {
    color: rgba(255,255,255,0.6);
}

.login-links {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
}

.login-links a {
    color: rgba(255,255,255,0.7);
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.login-links a:hover {
    color: #60a5fa;
    transform: translateY(-2px);
}

/* ===== INPUT ===== */
.input-glass {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 12px 15px;
    border-radius: 10px;

    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);

    transition: 0.3s;
}

.input-glass:hover {
    border-color: rgba(255,255,255,0.3);
}

.input-glass i {
    color: rgba(255,255,255,0.7);
    margin-right: 10px;
}

.input-glass input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    width: 100%;
}

/* ===== OPTIONS ===== */
.login-options {
    margin-bottom: 20px;
    color: rgba(255,255,255,0.7);
    font-size: 14px;
}

/* ===== BUTTON ===== */
.btn-glass {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;

    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-weight: 600;

    transition: 0.3s;
}

.btn-glass:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102,126,234,0.4);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 500px) {
    .login-glass {
        width: 90%;
        padding: 30px;
    }
}

</style>
@stop