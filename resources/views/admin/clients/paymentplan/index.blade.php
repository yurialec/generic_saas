@extends('layouts.app_admin')
@section('content')
    <clients-paymentplan-index-component
        url-create-paymentplan="{{ route('clients.paymentplan.create') }}">
    </clients-paymentplan-index-component>
@endsection
