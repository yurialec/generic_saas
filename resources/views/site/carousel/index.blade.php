@extends('layouts.app_admin')
@section('content')
<site-carrousel-index-component
    url-create-carousel="{{ route('site.carousel.create') }}">
</site-carrousel-index-component>
@endsection