<!-- Why Chose Us -->
<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="main-title text-center">
					@if(!empty($title))
						<h2>{{$title}}</h2>
					@endif
					@if(!empty($desc))
						<p>{{$desc}}</p>
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			@if(!empty($list_item))
				@foreach($list_item as $item)
					<div class="col-sm-6 col-lg-2 category-featured-box">
						@includeIf("Property::frontend.blocks.category-featured-box.style.".$style)
						
					</div>
				@endforeach
			@endif
		</div>
	</div>
</section>
