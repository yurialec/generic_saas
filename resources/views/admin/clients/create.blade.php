@extends('layouts.app_admin')
@section('content')
<clients-create-component
    url-index-client="{{ route('clients.index') }}">
</clients-create-component>
@endsection