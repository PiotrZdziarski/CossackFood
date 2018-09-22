'@extends('app')
@section('title') Menu @endsection
@section('content')
    <div class="clearfix"></div>
    <menu-subpage api_link="@php echo getenv('APP_URL') @endphp"></menu-subpage>
@endsection