@extends('layouts.app_tenant_admin')
@section('content')
    <tenant-patient-index-component
        url-create-patient="{{ route('tenant.patient.create', ['tenant' => session('tenant')]) }}">
    </tenant-patient-index-component>
@endsection