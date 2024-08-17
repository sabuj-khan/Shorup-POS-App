@extends('layouts.dashboard-layout')
@section('content')
    @include('components.invoice.invoice-list')
    @include('components.invoice.invoice-detail')
    @include('components.invoice.invoice-delete')
@endsection