@if(isTzSubDomain())
    <footer>
        <div class="footer-top-wrapper">
            <div class="width-900">
                <div class="social-wrapper bottom-line">
                    <div class="col-md-12 text-center">
                        <ul>
                            <li><a href="https://github.com/younginnovations/aidstream-tz" class="github" title="Fork us on Github">Fork us on Github</a></li>
                            <li><a href="https://twitter.com/aidstream" class="twitter" title="Follow us on Twitter">Follow us on Twitter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-nav bottom-line">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/who-is-using') }}">Who's Using It?</a></li>
                            {{--<li><a href="https://github.com/younginnovations/aidstream-tz/wiki/User-Guide" target="_blank">User Guide</a></li>--}}
                        </ul>
                        <ul>
                            @if(auth()->check())
                                <li><a href="{{ url((auth()->user()->role_id == 1 || auth()->user()->role_id == 2) ? route('lite.activity.index') : config('app.super_admin_dashboard'))}}">Go to Dashboard</a></li>
                            @else
                                <li><a href="{{ route('login.overridden') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="footer-logo">
                    <div class="col-md-12 text-center">
                    <a href="{{ url('/') }}" title="AidStream Tanzania"><img src="/images/ic_logo-aidstream-tz.svg" alt="AidStream Tanzania"></a>
                </div>
            </div>
        </div>
        </div>
        <div class="footer-bottom-wrapper">
            <div class="width-900">
                <div class="col-xs-12 col-sm-2 pull-left aidstream-logo"><a href="https://aidstream.org/" title="AidStream"><img src="/images/logo-aidstream.svg" alt="AidStream" width="142" height="37"></a></div>
                <div class="col-xs-12 col-sm-9 pull-right aidstream-info">
                    <p>AidStream Tanzania is a version of <a href="https://aidstream.org/">AidStream</a> customized to meet the needs of Tanzanian projects/ organizations. If you want to check out the un-customized AidStream, <a href="https://aidstream.org/">go here</a>. </p>
                </div>
            </div>
        </div>
        <!-- Google Analytics -->
    {{--<script type="text/javascript" src="{{url('/js/ga.js')}}"></script>--}}
    <!-- End Google Analytics -->
    </footer>
@else
    <footer>
    <div class="width-900">
        <div class="social-wrapper bottom-line">
            <div class="col-md-12 text-center">
                <ul>
                    <li><a href="https://github.com/younginnovations/aidstream-new" class="github" title="Fork us on Github">@lang('global.fork_us_on_github')</a></li>
                    <li><a href="https://twitter.com/aidstream" class="twitter" title="Follow us on Twitter">@lang('global.follow_us_on_twitter')</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-nav bottom-line">
            <div class="col-md-12">
                <ul>
                    <li><a href="{{ url('/about') }}">@lang('global.about')</a></li>
                    <li><a href="{{ url('/who-is-using') }}">@lang('global.who_is_using')</a></li>
                    @if (!isTzSubDomain())
                        <li><a href="https://github.com/younginnovations/aidstream-new/wiki/User-Guide" target="_blank">@lang('global.user_guide')</a></li>
                    @endif
                    <!--<li><a href="#">Snapshot</a></li>-->
                </ul>
                <ul>
                    @if(auth()->check())
                        <li>
                            <a href="{{ (auth()->user()->isSuperAdmin() || auth()->user()->isGroupAdmin() || auth()->user()->isDiAdmin()) ? url
                            (config('app.super_admin_dashboard')) : (auth()->user()->getSystemVersion() == 2) ? url(config('app.admin_lite_dashboard')) : url(config('app.admin_dashboard'))}}">@lang('global.go_to_dashboard')</a>
                        </li>
                    @else
                        <li><a href="{{ url('/auth/login') }}">@lang('global.login')</a></li>
                        <li><a href="{{ route('registration') }}">@lang('global.register')</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="footer-logo">
            <div class="col-md-12 text-center">
                <a href="{{ url('/') }}"><img src="/images/logo-aidstream.svg" alt=""></a>
            </div>
        </div>
    </div>
    <div class="width-900 text-center">
        <div class="col-md-12 support-desc">
            @lang('global.for_queries') <a href="mailto:support@aidstream.org">support@aidstream.org</a>
        </div>
    </div>
    <!-- Google Analytics -->
    <script type="text/javascript" src="{{url('/js/ga.js')}}"></script>
    <!-- End Google Analytics -->
</footer>
@endif
