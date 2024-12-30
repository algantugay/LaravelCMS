@extends('Frontend.main_master')

@section('main')
<div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
	<!--begin::Heading-->
	<div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
		<!--begin::Title-->
		<h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">	<span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
		<span id="kt_landing_hero_text">MOTOSİKLET</span>
		</span>
		<br />İLE ALAKALI HER ŞEY!
		</h1>
		<!--end::Title-->
	</div>
	<!--end::Heading-->

	<!--begin::Slider-->
	<div class="tns tns-default" style="direction: ltr">
		<!--begin::Slider-->
		<div
			data-tns="true"
			data-tns-loop="true"
			data-tns-swipe-angle="false"
			data-tns-speed="2000"
			data-tns-autoplay="true"
			data-tns-autoplay-timeout="5000"
			data-tns-controls="true"
			data-tns-nav="false"
			data-tns-items="4"
			data-tns-center="true"
			data-tns-dots="false"
			data-tns-prev-button="#kt_team_slider_prev1"
			data-tns-next-button="#kt_team_slider_next1">
	
			@php
				$pages = App\Models\Page::where('status', 'Published')->paginate(20);
			@endphp
	
			<!--begin::Item-->
			@foreach ($pages as $urun)
			<div class="text-center px-1 py-1">
				<img src="{{ asset('storage/' . ($urun->image_path ?? 'default.jpg')) }}" 
					 class="card-rounded mw-100" 
					 style="height: 200px; object-fit: cover;" 
					 alt="{{ $urun->title ?? 'No Title' }}" />
			</div>
			@endforeach
			<!--end::Item-->
		</div>
		<!--end::Slider-->
	
		<!--begin::Slider button-->
		<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
			<span class="svg-icon fs-3x">
				&lt;
			</span>
		</button>
		<!--end::Slider button-->
	
		<!--begin::Slider button-->
		<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
			<span class="svg-icon fs-3x">
				&gt;
			</span>
		</button>
		<!--end::Slider button-->
	</div>
	<!--end::Slider-->
	
</div>
@endsection

@section('main2')

			<!--begin::Product Section-->
			@include('Frontend.home.pages')
			<!--end::Product Section-->

			<!--begin::Comment Section-->
			@include('Frontend.home.comments')
			<!--end::Comment Section-->

@endsection