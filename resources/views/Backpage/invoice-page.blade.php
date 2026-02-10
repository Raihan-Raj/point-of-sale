@extends('layout.app')
@section('content')
  @include('invoice.invoice-list')
  @include('invoice.invoice-delete')
  @include('invoice.invoice-details')
@endsection