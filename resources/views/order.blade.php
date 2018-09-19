@extends('app')
@section('title') Order Online @endsection
@section('content')


    <order-online
            dishes_data="{{$dishes}}"
            pizzas_data="{{$pizzas}}"
            api_link="@php echo getenv('APP_URL') @endphp"
    ></order-online>
@endsection