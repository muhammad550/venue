@extends('layouts.app',['container_class'=>'container-fluid','header_right_menu'=>true])
@section('head')
@endsection
@section('content')
	<section id="feature-property" class="our-listing pt0 pb0">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="listing_sidebar">
						<div class="sidebar_content_details style3">
							<!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
							<div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
								<div class="sidebar_advanced_search_widget">
									<h4 class="mb25">{{__('Advanced Search')}} <a class="filter_closed_btn float-right" href="#"><small>{{__('Hide Filter')}}</small> <span
													class="flaticon-close"></span></a></h4>
									@includeIf('Property::frontend.layouts.form-search.sidebar')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-5">
					<div class="half_map_area_content mt30">
						<div class="row">
							<div class="listing_filter_row dif db-767">
								<div class="col-lg-5">
									<div class="left_area tac-xsd mb30-767">
										<div class="price_ranger_dropdown mb30-991">
											<ul class="mb0">
												<li class="list-inline-item mb30-767">
													<div class="sidebar_switch mb0">
														<div class="mobile_style">
															<span class="fa fa-filter filter_open_btn"> {{__('Open Filter')}}</span>
														</div>
													</div>
												</li>
												<li class="list-inline-item">
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="listing_list_style tac-767">
										@includeIf('Property::frontend.layouts.search.loop.orderby')
									</div>
								</div>
							</div>
						</div>
						@include('Property::frontend.layouts.search-map.list-item',['per_item_in_row'=>'col-md-6 col-lg-4'])
					</div>
				</div>
				<div class="col-xl-7">
					<div class="half_map_area">
						<div class="home_two_map">
							<div class="map-loading d-none">
								<div class="st-loader"></div>
							</div>
							<div id="bc_results_map" class="map-canvas half_style" data-map-zoom="9" data-map-scroll="true"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('footer')
	{!! App\Helpers\MapEngine::scripts() !!}
	<script>
        var bc_map_data = {
            markers:{!! json_encode($markers) !!}
        };
	</script>
	<script type="text/javascript" src="{{ asset('module/property/js/property-map.js?_ver='.config('app.asset_version')) }}"></script>
@endsection
