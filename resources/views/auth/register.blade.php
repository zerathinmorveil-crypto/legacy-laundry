@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('body')
<div class="split-wrapper">

    {{-- LEFT SIDE (Branding / Visual) --}}
    <div class="split-left">
        <div class="overlay"></div>

        <div class="content">
            <h1>Your clothes clean in a few minutes</h1>
            <p>
                Dapatkan pakaian Anda yang bersih dan rapi hanya dalam beberapa menit.
            </p>

            <div class="features">
                <div class="feature">
                    <i class="fas fa-shield-alt"></i>
                    <span>Kualitas Tinggi</span>
                </div>
                <div class="feature">
                    <i class="fas fa-bolt"></i>
                    <span>Proses Cepat</span>
                </div>
                <div class="feature">
                    <i class="fas fa-users"></i>
                    <span>Pelayanan Terbaik</span>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT SIDE (Form) --}}
    <div class="split-right">

        <div class="form-glass">

            <div class="form-header">
                <div class="logo">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>Create Account</h2>
                <p>Buat akun baru untuk memulai perjalanan Anda</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="input-glass">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                </div>

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

                {{-- Confirm --}}
                <div class="input-glass">
                    <i class="fas fa-lock-open"></i>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="btn-glass">
                    Buat Akun
                </button>
            </form>

            <div class="auth-footer">
                <p>Sudah punya akun? 
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </div>

        </div>

    </div>

</div>
@stop

@section('css')
<style>
/* RESET */
body.login-page {
    background: transparent !important;
}

/* WRAPPER */
.split-wrapper {
    display: flex;
    height: 100vh;
    width: 100%;
}

/* LEFT SIDE */
.split-left {
    flex: 1;
    position: relative;
    background: linear-gradient(135deg, #3a7d78, #1f3b57);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    overflow: hidden;
}

/* ANIMATED BG */
.split-left::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, #667eea, #764ba2, #6ee7b7);
    animation: moveBg 12s infinite linear;
    filter: blur(120px);
    opacity: 0.5;
}

@keyframes moveBg {
    0% { transform: rotate(0deg) translate(-20%, -20%); }
    100% { transform: rotate(360deg) translate(-20%, -20%); }
}

.overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.3);
}

/* CONTENT LEFT */
.split-left .content {
    position: relative;
    z-index: 2;
    max-width: 400px;
}

.split-left h1 {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 16px;
}

.split-left p {
    opacity: 0.8;
    margin-bottom: 30px;
}

/* FEATURES */
.features .feature {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.feature i {
    margin-right: 10px;
}

/* RIGHT SIDE */
.split-right {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #3a7d78, #1f3b57);
}

/* GLASS FORM */
.form-glass {
    width: 420px;
    padding: 48px;
    border-radius: 24px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(20px);

    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 25px 70px rgba(0,0,0,0.5);
}

/* HEADER */
.form-header {
    text-align: center;
    margin-bottom: 30px;
}

.logo {
    width: 70px;
    height: 70px;
    margin: auto;
    border-radius: 16px;
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

.form-header h2 {
    color: white;
}

.form-header p {
    color: rgba(255,255,255,0.7);
}

/* INPUT */
.input-glass {
    display: flex;
    align-items: center;
    padding: 14px;
    margin-bottom: 20px;
    border-radius: 12px;

    background: rgba(255,255,255,0.06);
}

.input-glass i {
    color: white;
    margin-right: 10px;
}

.input-glass input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    width: 100%;
}

/* BUTTON */
.btn-glass {
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-weight: 600;
    transition: 0.3s;
}

.btn-glass:hover {
    transform: translateY(-2px);
}

/* FOOTER */
.auth-footer {
    text-align: center;
    margin-top: 20px;
}

.auth-footer a {
    color: #60a5fa;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .split-left {
        display: none;
    }

    .split-right {
        flex: 1;
    }
}
</style>
@stop

@section('js')
<script>
// Form validation & loading state
document.querySelector('form').addEventListener('submit', function(e) {
    const btn = this.querySelector('.btn-glass');
    const btnText = btn.querySelector('.btn-text');
    const btnLoading = btn.querySelector('.btn-loading');
    
    btn.disabled = true;
    btnText.style.display = 'none';
    btnLoading.style.display = 'flex';
    
    // Reset after 5s (fallback)
    setTimeout(() => {
        btn.disabled = false;
        btnText.style.display = 'block';
        btnLoading.style.display = 'none';
    }, 5000);
});

// Auto focus
document.querySelector('input[name="name"]').focus();

// Password match validation
const password = document.querySelector('input[name="password"]');
const confirmPassword = document.querySelector('input[name="password_confirmation"]');

confirmPassword.addEventListener('input', function() {
    if (this.value && this.value !== password.value) {
        this.style.border = '1px solid #f87171';
    } else {
        this.style.border = 'none';
    }
});
</script>
@stop