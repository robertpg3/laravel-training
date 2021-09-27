@extends('layouts.datatable_layout')

@section('content')
    {{$dataTable->table()}}
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
