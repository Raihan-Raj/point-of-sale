@extends('layout.app')
@section('content')
  @include('product.product-create')
  @include('product.product-delete')
  @include('product.product-list')
  @include('product.product-update')
@endsection