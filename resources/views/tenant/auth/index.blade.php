@include('layouts.app_tenant')
<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                <span class="text-primary fs-4 fw-bold">Olá, {{ $name }}!</span>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid mt-3" alt="Ilustração">
            </div>
            <div class="col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Acesse sua conta</h4>
                        <form method="POST"
                            action="{{ route('tenant.login', ['tenant' => request()->route('tenant')]) }}"> @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Endereço de e-mail</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Digite seu e-mail" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Digite sua senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>