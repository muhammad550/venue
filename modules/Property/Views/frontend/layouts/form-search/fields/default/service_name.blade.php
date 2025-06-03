<div class="col-auto  home_form_input bgc-white mb20-xsd">
    <label class="sr-only">{{$holder}}</label>
    <div class="input-group style1">
        <div class="input-group-prepend">
            <div class="input-group-text pl0 pb0-767">{{$holder}}</div>
        </div>
        <div class="select-wrap style2-dropdown">
            <input type="text" class="form-control refineText formTextbox" id="ServiceName" name="{{$name}}"  value="{{Request::input('service_name')}}" placeholder="{{__('What are you looking for')}}">
        </div>
    </div>
</div>
