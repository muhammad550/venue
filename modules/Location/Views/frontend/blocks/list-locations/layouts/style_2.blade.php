@php
    $translation = $row->translateOrOrigin(app()->getLocale());
    $link_location = false;
    if(is_string($service_type)){
        $link_location = $row->getLinkForPageSearch($service_type);
    }
    if(is_array($service_type) and count($service_type) == 1){
        $link_location = $row->getLinkForPageSearch($service_type[0] ?? "");
    }
    if($to_location_detail){
        $link_location = $row->getDetailUrl();
    }
@endphp

<div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
    <div class="property_city_home6" @if(!empty($link_location)) onclick="window.location.href='{{$link_location}}'" @endif>
            <div class="thumb"><img class="w100" src="{{$row->getImageUrl()}}" alt="{{$translation->name}}"></div>
            <div class="details">
                <h4>{{$translation->name}}</h4>
                <p>
                    @foreach($service_type as $type)
                        <?php
                            $stringCount = $type.'_count';
                            $count = 0;
                            if(Arr::exists(get_bookable_services(),$type)){
                                $count = !empty($row->$stringCount)?$row->$stringCount:0;
                            }
                        ;?>
                        @if(!empty($count))
                            @if(!empty($link_location))
                                <a class="text-capitalize" href="{{ $row->getLinkForPageSearch( $type ) }}" target="_blank">
                                    {{$count}} {{Str::pluralStudly($type, $count)}}
                                </a>
                            @else
                                <span class="text-capitalize">{{$count}} {{Str::pluralStudly($type, $count)}}</span>
                            @endif
                        @endif
                    @endforeach
                </p>
            </div>
    </div>
</div>
