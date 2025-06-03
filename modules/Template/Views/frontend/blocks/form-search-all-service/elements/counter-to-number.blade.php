@foreach($counter_to_list as $item)
	<div class="col-sm-6 col-md-4 col-lg-4">
		<div class="funfact_one text-center">
			<div class="details">
				@if(!empty($item['suffix']))
					<ul>
						<li class="list-inline-item"><div class="timer">{{$item['number']??0}}</div></li>
						<li class="list-inline-item"><span>{{$item['suffix']}}</span></li>
					</ul>
				@else
					<div class="timer">{{$item['number']??0}}</div>
				@endif
				<h4 class="ff_title">{{$item['title']}}</h4>
			</div>
		</div>
	</div>
@endforeach