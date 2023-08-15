@extends('zealov::layout.frame')

@section('icon'){{""}}@endsection
@section('title'){{app('SystemConfig')->value('siteName')}}@endsection
@section('keywords'){{app('SystemConfig')->value('siteKeywords')}}@endsection
@section('description'){{app('SystemConfig')->value('siteDescription')}}@endsection
{!! \Zealov\Zealov::css('asset/layui/css/layui.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/video-js.min.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/swiper-bundle.min.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/iconfont.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/animate.min.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/css.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/style.css') !!}
