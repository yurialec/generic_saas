@extends('layouts.app_tenant_admin')
@section('content')
    <tenant-profile-index-component
        :user="{{(Auth::guard('client')->user())}}">
    </tenant-profile-index-component>
@endsection
