<?php
		$href = '';
		if(!empty($item['category'])){
		    $href = route('property.category.detail',['slug'=>$item['category']['slug']]);
		}
	;?>
<div class="icon-box text-center" @if(!empty($href)) onclick=" window.location.href='{{$href}}'" @endif>
	<div class="icon"><span class="{{!empty($item['icon'])?$item['icon']:""}}"></span></div>
	<div class="content-details">
		<div class="title">{{!empty($item['title'])?$item['title']:""}}</div>
	</div>
</div>