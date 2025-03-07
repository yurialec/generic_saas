@extends('layouts.app_admin')
@section('content')
    <clients-edit-component
        :id="{{$id}}"
        url-index-client="{{ route('clients.index') }}">
    </clients-edit-component>
@endsection
