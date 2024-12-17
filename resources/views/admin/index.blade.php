@extends('layouts.app')
@section('title', 'Dashboard - Admin Panel')
@push('style')
    <style>
    
    </style>
@endpush

@section('section')
    <div>
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

       
    </div>
    @push('scriptss')
    <script>
    console.log('Hellow World');
    </script>
@endpush
@endsection
