@extends('layouts.app')
@section('content')
    <!-- Our Coming Soon Page -->
    <section class="our-coming-soon">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="error_page footer_apps_widget text-center">
                        <img class="img-fluid" src="{{get_file_url(setting_item("maintenance_mode_img"),"full")}}" alt="coming-soon.png">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="error_page footer_apps_widget">
                        <div class="erro_code">
                            <h1>{{ setting_item_with_lang('maintenance_mode_title') }}</h1>
                        </div>
                        <p>{{ setting_item_with_lang('maintenance_mode_desc') }}</p>
                        <div class="event_counter_plugin_container mt30 mb20">
                            <div class="event_counter_plugin_content">
                                <ul>
                                    <li><span id="days"></span><div class="time_text">days</div></li>
                                    <li><span id="hours"></span><div class="time_text">Hours</div></li>
                                    <li><span id="minutes"></span><div class="time_text">Minutes</div></li>
                                    <li><span id="seconds"></span><div class="time_text">Seconds</div></li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{route('newsletter.subscribe')}}" class="form-inline mailchimp_form subcribe-form bc-subscribe-form bc-form footer_mailchimp_form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-row align-items-center">
                                <label class="sr-only" for="inlineFormInputName">Name</label>
                                <input type="text" name="email" class="form-control mb-2 mr-sm-2 email-input" placeholder="Enter your email">
                                <button type="submit" class="btn btn-primary mb-2">
                                    Subscribe <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                </button>
                            </div>
                            <div class="form-mess"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;
        let countDown = new Date('{{setting_item('maintenance_mode_time')}}').getTime(),
            x = setInterval(function() {
                let now = new Date().getTime(),
                    distance = countDown - now;
                document.getElementById('days').innerText = Math.floor(distance / (day)),
                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
                    document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
            }, second)
    </script>
@endsection

@section('footer')

@endsection
