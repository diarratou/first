<x-guest-layout>
<div class="modern-login-container">
    <!-- Background Elements -->
    <div class="bg-elements">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
    </div>

    <!-- Login Card -->
    <div class="login-card">
        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-logo">
                <div class="logo-icon">🍔</div>
                <div class="logo-animation"></div>
            </div>
            <h1 class="brand-title">IPP BURGER</h1>
            <p class="brand-subtitle">Connexion à votre espace</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="session-status mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <div class="input-container">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <x-text-input
                        id="email"
                        class="modern-input"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Votre adresse email"
                    />
                    <x-input-label for="email" :value="__('Email')" class="floating-label" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="input-error" />
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <div class="input-container">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <x-text-input
                        id="password"
                        class="modern-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Votre mot de passe"
                    />
                    <x-input-label for="password" :value="__('Mot de passe')" class="floating-label" />
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="password-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="input-error" />
            </div>

            <!-- Remember Me -->
            <div class="form-options">
                <label for="remember_me" class="remember-checkbox">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="checkmark">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="checkbox-text">Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="form-submit">
                <x-primary-button class="login-btn">
                    <span class="btn-text">Se connecter</span>
                    <i class="fas fa-arrow-right btn-icon"></i>
                    <div class="btn-ripple"></div>
                </x-primary-button>
            </div>
        </form>

        <!-- Additional Options -->
        <div class="login-footer">
            <div class="signup-link">
                <span>Pas encore de compte ?</span>
                <a href="{{ route('register') }}">Créer un compte</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <div class="feature-content">
                <h3>Livraison rapide</h3>
                <p>En moins de 30 minutes</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="feature-content">
                <h3>Paiement sécurisé</h3>
                <p>Vos données protégées</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="feature-content">
                <h3>Qualité garantie</h3>
                <p>Ingrédients frais</p>
            </div>
        </div>
    </div>
</div>

<style>
.modern-login-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #1a1a1a 0%, #2d1b69 100%);
    display: grid;
    grid-template-columns: 1fr;
    place-items: center;
    padding: 40px 20px;
    position: relative;
    overflow: hidden;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.bg-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 1;
}

.bg-circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(233, 30, 99, 0.1), rgba(173, 20, 87, 0.05));
    animation: float 6s ease-in-out infinite;
}

.circle-1 {
    width: 300px;
    height: 300px;
    top: -150px;
    right: -150px;
    animation-delay: 0s;
}

.circle-2 {
    width: 200px;
    height: 200px;
    bottom: -100px;
    left: -100px;
    animation-delay: 2s;
}

.circle-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    right: 10%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.login-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 50px 45px;
    width: 100%;
    max-width: 480px;
    position: relative;
    z-index: 2;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    margin: auto;
}

.brand-section {
    text-align: center;
    margin-bottom: 40px;
}

.brand-logo {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.logo-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e91e63, #ad1457);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    box-shadow: 0 10px 30px rgba(233, 30, 99, 0.3);
}

.logo-animation {
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    border-radius: 25px;
    background: linear-gradient(45deg, #e91e63, #ad1457, #e91e63);
    background-size: 200% 200%;
    animation: gradientShift 3s ease infinite;
    z-index: 1;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.brand-title {
    font-size: 2.2rem;
    font-weight: 800;
    background: linear-gradient(45deg, #fff, #ffeb3b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
    letter-spacing: -0.5px;
}

.brand-subtitle {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
    margin: 8px 0 0 0;
}

.session-status {
    background: rgba(76, 175, 80, 0.1);
    color: #4caf50;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid rgba(76, 175, 80, 0.2);
    text-align: center;
    font-size: 0.9rem;
}

.login-form {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 28px;
}

.input-container {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.5);
    z-index: 2;
    transition: color 0.3s ease;
    font-size: 1.1rem;
}

.modern-input {
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    padding: 18px 18px 18px 55px;
    color: white;
    font-size: 1.05rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.modern-input:focus {
    outline: none;
    border-color: #e91e63;
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 4px rgba(233, 30, 99, 0.1);
}

.modern-input:focus + .floating-label,
.modern-input:not(:placeholder-shown) + .floating-label {
    transform: translateY(-35px) scale(0.85);
    color: #e91e63;
}

.modern-input:focus ~ .input-icon {
    color: #e91e63;
}

.floating-label {
    position: absolute;
    left: 55px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.6);
    transition: all 0.3s ease;
    pointer-events: none;
    font-size: 1.05rem;
}

.password-toggle {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.password-toggle:hover {
    color: #e91e63;
    background: rgba(233, 30, 99, 0.1);
}

.input-error {
    color: #f44336;
    font-size: 0.85rem;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.input-error::before {
    content: '⚠';
    font-size: 0.9rem;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.remember-checkbox {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    position: relative;
}

.remember-checkbox input {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.remember-checkbox input:checked ~ .checkmark {
    background: linear-gradient(135deg, #e91e63, #ad1457);
    border-color: #e91e63;
}

.checkmark i {
    color: white;
    font-size: 0.8rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.remember-checkbox input:checked ~ .checkmark i {
    opacity: 1;
}

.checkbox-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
}

.forgot-password {
    color: #e91e63;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.forgot-password:hover {
    color: #ad1457;
    text-decoration: underline;
}

.login-btn {
    width: 100%;
    background: linear-gradient(135deg, #e91e63, #ad1457);
    border: none;
    border-radius: 16px;
    padding: 18px;
    color: white;
    font-size: 1.15rem;
    font-weight: 600;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-top: 8px;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(233, 30, 99, 0.4);
}

.btn-icon {
    transition: transform 0.3s ease;
}

.login-btn:hover .btn-icon {
    transform: translateX(4px);
}

.btn-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.login-btn:active .btn-ripple {
    width: 300px;
    height: 300px;
}

/* Suppression des styles des boutons sociaux */
.social-login {
    display: none;
}

.social-btn, .google-btn, .facebook-btn {
    display: none;
}

.divider {
    display: none;
}

.signup-link {
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
    margin-top: 25px;
}

.signup-link a {
    color: #e91e63;
    text-decoration: none;
    font-weight: 600;
    margin-left: 6px;
}

.signup-link a:hover {
    text-decoration: underline;
}

.features-section {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: center;
    gap: 30px;
    z-index: 1;
    max-width: 900px;
    width: 100%;
    padding: 0 20px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 16px 20px;
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.feature-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #e91e63, #ad1457);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.feature-content h3 {
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
    margin: 0;
}

.feature-content p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.8rem;
    margin: 2px 0 0 0;
}

@media (max-width: 1200px) {
    .features-section {
        gap: 20px;
    }

    .feature-item {
        padding: 14px 16px;
    }
}

@media (max-width: 768px) {
    .modern-login-container {
        padding: 20px 15px;
        grid-template-rows: 1fr auto;
    }

    .login-card {
        padding: 40px 25px;
        max-width: none;
        margin-bottom: 20px;
    }

    .brand-title {
        font-size: 1.9rem;
    }

    .form-options {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }

    .features-section {
        position: relative;
        bottom: auto;
        transform: none;
        flex-direction: column;
        gap: 12px;
        margin-top: 0;
        padding: 0 15px;
    }

    .feature-item {
        justify-content: center;
        max-width: 300px;
        margin: 0 auto;
    }
}

@media (max-width: 480px) {
    .login-card {
        padding: 35px 20px;
    }

    .modern-input {
        padding: 16px 16px 16px 50px;
        font-size: 1rem;
    }

    .floating-label {
        left: 50px;
        font-size: 1rem;
    }

    .input-icon {
        left: 16px;
        font-size: 1rem;
    }

    .login-btn {
        padding: 16px;
        font-size: 1.05rem;
    }

    .circle-1, .circle-2, .circle-3 {
        display: none;
    }
}}

    .brand-title {
        font-size: 1.8rem;
    }

    .form-options {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }

    .features-section {
        position: static;
        flex-direction: column;
        gap: 12px;
        margin-top: 30px;
    }

    .feature-item {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .social-login {
        flex-direction: column;
    }

    .circle-1, .circle-2, .circle-3 {
        display: none;
    }
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordEye = document.getElementById('password-eye');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordEye.classList.remove('fa-eye');
        passwordEye.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordEye.classList.remove('fa-eye-slash');
        passwordEye.classList.add('fa-eye');
    }
}

function loginWithGoogle() {
    // Logique pour la connexion Google
    console.log('Connexion avec Google');
}

function loginWithFacebook() {
    // Logique pour la connexion Facebook
    console.log('Connexion avec Facebook');
}

// Animation des éléments au chargement
document.addEventListener('DOMContentLoaded', function() {
    const card = document.querySelector('.login-card');
    const features = document.querySelectorAll('.feature-item');

    // Animation de la carte de connexion
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';

    setTimeout(() => {
        card.style.transition = 'all 0.8s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 200);

    // Animation des fonctionnalités
    features.forEach((feature, index) => {
        feature.style.opacity = '0';
        feature.style.transform = 'translateY(20px)';

        setTimeout(() => {
            feature.style.transition = 'all 0.6s ease';
            feature.style.opacity = '1';
            feature.style.transform = 'translateY(0)';
        }, 600 + (index * 150));
    });
});
</script>
</x-guest-layout>
