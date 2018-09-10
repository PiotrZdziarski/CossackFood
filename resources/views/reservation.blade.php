@extends('app')
@section('title') Reservations @endsection
@section('content')
    <div class="clearfix"></div>
    <reservations api_link="@php echo getenv('APP_URL') @endphp"></reservations>
@endsection