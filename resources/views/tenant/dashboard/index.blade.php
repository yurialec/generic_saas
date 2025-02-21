@extends('layouts.app_tenant_admin')
@section('content')
    <div class="container">
        <h2>Bem-vindo {{ session('user')['name'] }}!</h2>
        <p>Aqui estão as informações do painel.</p>
    </div>
@endsection