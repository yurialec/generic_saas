@extends('layouts.app_tenant_admin')
@section('content')
    <tenant-profile-index-component
        tenant={{session('tenant')}}>
    </tenant-profile-index-component>
@endsection
