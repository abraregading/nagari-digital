@extends('site.layouts.app')


@section('content')
    @include('site.layouts.konten.stats')
    @include('site.layouts.konten.products')
    @include('site.layouts.konten.demo')
    @include('site.layouts.konten.why')
    @include('site.layouts.konten.preview')
    @include('site.layouts.konten.testimonials')
    @include('site.layouts.konten.cta')

@endsection