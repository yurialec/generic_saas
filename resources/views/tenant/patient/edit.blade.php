@extends('layouts.app_tenant_admin')
@section('content')
    <tenant-patient-edit-component
        :id={{$id}}
        url-index-patient="{{ route('tenant.patient.index', ['tenant' => session('tenant')]) }}">
    </tenant-patient-edit-component>
@endsection