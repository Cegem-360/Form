@extends('components.layouts.errors.layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    <span class="block mb-2 text-2xl font-bold text-gray-700 dark:text-gray-200">Az oldal nem található</span>
    <span class="block text-base text-gray-500 dark:text-gray-400">A keresett oldal nem létezik vagy már
        eltávolították.</span>
@endsection

@if (config('app.debug') && isset($exception))
    <div
        class="p-4 mt-8 overflow-x-auto text-xs text-left text-red-700 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/40 dark:text-red-200 dark:border-red-800">
        <strong class="block mb-2 text-red-800 dark:text-red-300">Exception:</strong>
        <div class="mb-2 font-mono break-words">{{ $exception->getMessage() }}</div>
        <pre class="font-mono text-xs leading-tight whitespace-pre-wrap">{{ $exception->getTraceAsString() }}</pre>
    </div>
@endif

{{-- This file was renamed to disable custom error view and enable Laravel's default error handler. --}}
