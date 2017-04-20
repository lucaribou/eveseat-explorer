@extends('web::layouts.grids.12')

@section('title', trans('explorer::words.auth'))
@section('page_header', trans('explorer::words.auth'))


@section('full')
	<a href="{{ $url }}">
		<img src="https://images.contentful.com/idjq7aai9ylm/4fSjj56uD6CYwYyus4KmES/4f6385c91e6de56274d99496e6adebab/EVE_SSO_Login_Buttons_Large_Black.png?w=270&h=45" alt="EVE SSO">
	</a>
@stop