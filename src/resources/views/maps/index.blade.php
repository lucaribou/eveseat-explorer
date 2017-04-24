@extends('web::layouts.grids.12')

@section('title', trans('explorer::words.maps'))
@section('page_header', trans('explorer::words.maps'))


@section('full')
	{{$location->solar_system_id}}
@stop