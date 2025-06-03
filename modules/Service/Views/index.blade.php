@extends('layouts.app')
@section('head')
	<style type="text/css">
		.bc-contact-block .section{
			padding: 80px 0 !important;
		}
	</style>
@endsection
@section('content')
<div id="bc_content-wrapper">
	@include("Service::frontend.blocks.service.index")
</div>
@endsection

@section('footer')

@endsection
