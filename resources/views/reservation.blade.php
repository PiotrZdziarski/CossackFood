@extends('app')
@section('title') Reservations @endsection
@section('content')
    <reservations api_link="@php echo getenv('APP_URL') @endphp"></reservations>
@endsection