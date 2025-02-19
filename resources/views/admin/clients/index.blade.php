@extends('layouts.app_admin')
@section('content')
    <clients-index-component
        url-create-client="{{ route('clients.create') }}">
    </clients-index-component>
@endsection
