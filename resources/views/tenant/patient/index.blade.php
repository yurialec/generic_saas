@extends('layouts.app_tenant_admin')
@section('content')
    <tenant-patient-index-component
        :tenant="{{session('tenant')}}"
        url-create-patient="{{ route('tenant.patient.create', ['tenant' => session('tenant')]) }}">
    </tenant-patient-index-component>
@endsection