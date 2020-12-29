@extends('core/base::layouts.master')
@section('content')
    <h1 class="text-white"> {{ __('plugins/example::example.text') }}</h1>
    <p class="text-white">Version: {{ config('plugins.example.example.version') }}</p>
@endsection
