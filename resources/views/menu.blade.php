@extends('app')
@section('title') Menu @endsection
@section('content')
    <menu-subpage api_link="@php echo getenv('APP_URL') @endphp"></menu-subpage>
@endsection