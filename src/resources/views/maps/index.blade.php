@extends('web::layouts.grids.12')

@section('title', trans('explorer::words.maps'))
@section('page_header', trans('explorer::words.maps'))

@section('full')
	<div id="map"></div>
	{{ $location->itemID }} {{ $location->itemName }}
@stop

@push('head')
	<link rel="stylesheet" href="{{ asset('web/css/cara/explorer/map.css') }}" />
@endpush

@push('javascript')	
	<script src="{{ asset('web/js/cara/explorer/sigma/sigma.min.js') }}"></script>
	<script src="{{ asset('web/js/cara/explorer/sigma/sigma.plugins.dragNodes.min.js') }}"></script>
	<script src="{{ asset('web/js/cara/explorer/sigma/sigma.parsers.json.min.js') }}"></script>
	<script>
		var data = {
		  "nodes": [
		    {
		      "id": "n0",
		      "label": "A node",
		      "x": 0,
		      "y": 0,
		      "size": 3
		    },
		    {
		      "id": "n1",
		      "label": "Another node",
		      "x": 3,
		      "y": 1,
		      "size": 2
		    },
		    {
		      "id": "n2",
		      "label": "And a last one",
		      "x": 1,
		      "y": 3,
		      "size": 1
		    }
		  ],
		  "edges": [
		    {
		      "id": "e0",
		      "source": "n0",
		      "target": "n1"
		    },
		    {
		      "id": "e1",
		      "source": "n1",
		      "target": "n2"
		    },
		    {
		      "id": "e2",
		      "source": "n2",
		      "target": "n0"
		    }
		  ]
		}
		
		var s = new sigma({
			graph: data,
			container: "map",
			settings: {
		        autoRescale: false,
		        fixedScaling: true
		    }
		});
		var dragListener = sigma.plugins.dragNodes(s, s.renderers[0]);

	</script>
@endpush