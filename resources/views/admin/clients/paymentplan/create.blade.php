@extends('layouts.app_admin')
@section('content')
<clients-paymentplan-create-component
    url-index-paymentplan="{{ route('clients.paymentplan.index') }}">
</clients-paymentplan-create-component>
@endsection