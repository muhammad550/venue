<!-- 6th Home Design -->
@php
	$backgroundUrl = get_file_url(setting_item("property_page_search_background"),"full");
@endphp
<section class="listing-home-bg parallax pt30-520" data-stellar-background-ratio="0.2" style="background-image: url({{ $backgroundUrl }})">
	<div class="container">
		<div class="row posr">
			<div class="col-lg-12">
				<div class="paralax_home_search_content mt50 mt0-767">
					<div class="home-text text-center">
						<h2 class="fz50">{{setting_item_with_lang('property_page_search_title', '', __('List Property'))}}</h2>
						<p class="fz18 color-white">{{setting_item_with_lang('property_page_search_sub_title', '', __('Property'))}}</p>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-10 col-xl-8">
							<div class="home_adv_srch_opt text-center mt0-767">
								<div class="wrapper">
									<div class="home_adv_srch_form">
										@includeIf('Property::frontend.layouts.search.form-search')
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="our-listing pb30-991">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="dn db-lg mt30 mb0 tac-767">
					<div id="main2">
						<span id="open2" class="fa fa-filter filter_open_btn style2"> {{ __("Show Filter") }}</span>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				@includeIf('Property::frontend.layouts.search.filter-search-mobile')
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="row">
					<div class="listing_filter_row dif db-767">
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-5">
							<div class="left_area tac-xsd mb30-767">
								<div class="price_ranger_dropdown mb30-991">
									<form class="form-property-search" method="get">
									<ul class="mb0 mt10">
										@if(!empty($list_category))
										<li class="list-inline-item mb30-991">
											<select onchange="$('.form-property-search').submit()" class="selectpicker show-tick">
												<option value="">{{__('Categories')}}</option>
												@foreach($list_category as $category)
												<option value="{{$category->id}}">{{$category->name}}</option>
												@endforeach
											</select>
										</li>
										@endif
										<li class="list-inline-item mb30-991">
											<div class="listing_price_tag">
												<div class="tag_btn mega_tags_dropdown">{{__('Attributes')}} <span class="fa fa-angle-down"></span></div>
												<div class="tag_dropdown_content">
													<div class="row">
														@foreach($attributes as $attribute)
															<div class="col-lg-6">
																<div class="font-weight-bold">{{$attribute->name}}</div>
																@foreach($attribute->terms as $term)
																	<ul class="ui_kit_checkbox selectable-list tal-767">
																		<li>
																			<div class="custom-control custom-checkbox">
																				<input onchange="$('.form-property-search').submit()" type="checkbox" class="custom-control-input" name="terms[]" value="{{$term->id}}"
																				       id="customCheck{{$term->id}}"
																				       @if(!empty(Request::input('terms')))
																				       @foreach(Request::input('terms') as $t)
																				       @if($t == $term->id)
																				       checked
																						@endif
																						@endforeach
																						@endif
																				>
																				<label class="custom-control-label mb-0" for="customCheck{{$term->id}}">{{$term->name}}</label>
																			</div>
																		</li>
																	</ul>
																@endforeach
															</div>
														@endforeach
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<select onchange="$('.form-property-search').submit()" name="price_range" class="selectpicker show-tick">
												<option value="">{{__('Price Range')}}</option>
												<option value="0">{{__("Free")}}</option>
												<option value="1">{{__('Low: $')}}</option>
												<option value="3">{{__('Medium: $$$')}}</option>
												<option value="5">{{__('High: $$$$$')}}</option>
											</select>
										</li>
									</ul>
									</form>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-7">
							<div class="listing_list_style tac-767">
                                @include('Property::frontend.layouts.search.loop.orderby')
							</div>
						</div>
					</div>
				</div>
				<div class="list-item">
					<div class="row">
                        @php $layout = Request::input('layout') @endphp
						@if($rows->total() > 0)
							@foreach($rows as $row)
                                @if($layout == 'list')
                                    <div class="item-listting col-lg-12">
                                        @include('Property::frontend.layouts.search.loop.loop-list')
                                    </div>
                                @else
                                    <div class="item-listting col-lg-4 col-md-4">
                                        @include('Property::frontend.layouts.search.loop.loop-gird')
                                    </div>
                                @endif
							@endforeach
						@else
							<div class="col-lg-12">
								<div class="border rounded p-3 bg-white">
									{{__("Property not found")}}
								</div>
							</div>
						@endif
					</div>
				</div>
				<div class="col-lg-12 mt20">
					<div class="mbp_pagination">
						{{$rows->appends(request()->query())->links()}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
