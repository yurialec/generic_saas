<?php

namespace App\Http\Controllers\Tenants;
use App\Http\Controllers\Controller;

class TenantController extends Controller
{
    public function getMenu()
    {
        return [
            [
                'url' => route('tenant.reports', ['tenant' => session('tenant')]),
                'icon' => 'nav-icon fas fa-chart-bar',
                'name' => 'Relatórios',
            ],
            [
                'url' => route('tenant.finance.index', ['tenant' => session('tenant')]),
                'icon' => 'nav-icon fas fa-dollar-sign',
                'name' => 'Financeiro',
            ],
            [
                'url' => route('tenant.patient.index', ['tenant' => session('tenant')]),
                'icon' => 'nav-icon fas fa-user-injured',
                'name' => 'Paciente',
            ],
            [
                'url' => route('tenant.appointments', ['tenant' => session('tenant')]),
                'icon' => 'nav-icon fas fa-calendar-alt',
                'name' => 'Consulta/Agenda',
            ],
            [
                'url' => route('tenant.configuration', ['tenant' => session('tenant')]),
                'icon' => 'nav-icon fas fa-cogs',
                'name' => 'Configurações',
            ],
            [
                'url' => route('tenant.logout', ['tenant' => session('tenant')]),
                'icon' => 'nav-icon fas fa-sign-out-alt',
                'name' => 'Sair',
            ],
        ];
    }

    public function dashboard()
    {
        return view('tenant.dashboard.index');
    }

    public function profile()
    {
        return view('tenant.profile.index');
    }

    public function reports()
    {
        return 'reports';
    }

    public function finance()
    {
        return 'finance';
    }

    public function patients()
    {
        return 'patients';
    }

    public function appointments()
    {
        return 'appointments';
    }

    public function configuration()
    {
        return view('tenant.configuration.index');
    }
}