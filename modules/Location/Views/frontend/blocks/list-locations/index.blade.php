<div class="container">
    <div class="bc-list-locations pt70 pb70 @if(!empty($layout)) {{ $layout }} @endif">
        <div class="main-title text-center">
            <div class="title  ">
                {{$title}}
            </div>
            @if(!empty($desc))
                <div class="sub-title ">
                    {{$desc}}
                </div>
            @endif
        </div>
        @if(!empty($rows))
            <div class="list-item">
                <div class="row ">
                    @foreach($rows as $key=>$row)
                        @includeIf('Location::frontend.blocks.list-locations.layouts.'.$layout)
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
