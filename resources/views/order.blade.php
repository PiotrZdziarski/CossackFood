@extends('app')
@section('title') Order Online @endsection
@section('content')
    <order-online api_link="@php echo getenv('APP_URL') @endphp"></order-online>
@endsection