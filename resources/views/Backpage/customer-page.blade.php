@extends('layout.app')
@section('content')
     @include('customer.customer-list')
     @include('customer.customer-delete')
     @include('customer.customer-create')
     @include('customer.customer-update')
@endsection