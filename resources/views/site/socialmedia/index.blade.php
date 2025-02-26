@extends('layouts.app_admin')
@section('content')
<site-social-media-create-component
    url-create-social-media="{{ route('site.socialmedia.create') }}">
</site-social-media-create-component>
@endsection