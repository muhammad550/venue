<?php
    $bg = '';
	if(!empty($item['bg_image'])){
        $bg = get_file_url($item['bg_image'],'full');
    }
    $href = '';
    if(!empty($item['category'])){
        $href = route('property.category.detail',['slug'=>$item['category']['slug']]);
	}
	?>

<div class="icon_hvr_img_box"  @if(!empty($bg)) style="background-image: url({{$bg}});" @endif
@if(!empty($href)) onclick=" window.location.href='{{$href}}'" @endif >
	<div class="overlay">
		<div class="icon"><span class="{{!empty($item['icon'])?$item['icon']:""}}"></span></div>
		<div class="details">
			<h5 class="title">{{!empty($item['title'])?$item['title']:""}}</h5>
		</div>
	</div>
</div>