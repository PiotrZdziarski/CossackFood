@extends('app')
@section('title') Order Online @endsection
@section('content')


    <order-online
            dishes_data="{{$dishes}}"
            api_link="@php echo getenv('APP_URL') @endphp"
            dishes_count="{{$dishesCount}}"
    ></order-online>
@endsection