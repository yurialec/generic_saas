@extends('layouts.app_tenant_admin')
@section('content')
<tenant-patient-create-component
    url-index-patient="{{ route('tenant.patient.index', ['tenant' => session('tenant')]) }}"
    :tenant="{{session('tenant')}}">
</tenant-patient-create-component>
@endsection