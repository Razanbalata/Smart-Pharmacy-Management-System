@extends('pdf.layouts.report')

@section('content')
    @include('pdf.components.header')
    
    @include('pdf.components.summary')
    
    @include('pdf.components.table')
    
    @include('pdf.components.footer')
@endsection
