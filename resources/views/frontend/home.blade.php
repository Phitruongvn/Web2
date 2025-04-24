@extends('layouts.site')
@section('title', 'Trang chủ')
@section('content')

<!-- Slider Section -->
<x-slider-show />

<!-- Product Sale Section -->
<x-product-sale :products="$products" />

<!-- Product New Section -->
<x-product-new :products="$products" />

@endsection 