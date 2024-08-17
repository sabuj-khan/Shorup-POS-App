@extends('layouts.dashboard-layout')
@section('content')
    @include('components.customer.customer-list')
    @include('components.customer.customer-create')
    @include('components.customer.customer-update')
    @include('components.customer.customer-delete')
@endsection