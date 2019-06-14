<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <title>@lang('title.aidstream_register')</title>
    @if(isTzSubDomain())
        <link rel="shortcut icon" type="image/png" sizes="32*32" href="{{ asset('/images/favicon-tz.png') }}"/>
    @else
        <link rel="shortcut icon" type="image/png" sizes="32*32" href="{{ asset('/images/favicon.png') }}"/>
    @endif
    <link href="{{ asset('/css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.min.css') }}" rel="stylesheet">
    @if(isTzSubDomain())
        <link rel="stylesheet" href="{{ asset('/tz/css/tz.min.css') }}">
    @endif

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('head')
</head>
<body>
@include('includes.header_home')
<div class="login-wrapper">
    {{--    <div class="language-select-wrapper">
            <label for="" class="pull-left">Language</label>

            <div class="language-selector pull-left">
                <span class="flag-wrapper"><span class="img-thumbnail flag flag-icon-background flag-icon-{{ config('app.locale') }}"></span></span>
                <span class="caret pull-right"></span>
            </div>
            <ul class="language-select-wrap language-flag-wrap">
                @foreach(config('app.locales') as $key => $val)
                    <li class="flag-wrapper" data-lang="{{ $key }}"><span class="img-thumbnail flag flag-icon-background flag-icon-{{ $key }}"></span><span class="language">{{ $val }}</span></li>
                @endforeach
            </ul>
        </div>--}}
    <div class="container-fluid register-container">
        <div class="row">
            <h1 class="text-center">@lang('registration.get_started_with_aidstream')</h1>
            <p class="text-center">@lang('registration.register_your_organisation_text')</p>
            <ul class="nav nav-tabs text-center" role="tablist">
                <li role="presentation" class="active"><span>1</span><a href="#tab-organization" aria-controls="tab-organization" role="tab"
                                                                        data-toggle="tab">@lang('registration.organisation_information')</a></li>
                <li role="presentation"><span>2</span><a href="#tab-users" aria-controls="tab-users" role="tab" data-toggle="tab">@lang('registration.administrator_information')</a></li>
                <li role="presentation"><span>3</span><a href="#tab-verification" aria-controls="tab-verification" role="tab" data-toggle="tab"
                                                         class="disabled">@lang('registration.email_verification')</a></li>
            </ul>
            <div class="col-lg-4 col-md-8 register-block">
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('includes.response')       
                        {{--*/ $regInfo = (array) (old() ? old() : session('reg_info')); /*--}}
                        {{ Form::model($regInfo, ['url' => route('registration.register'), 'method' => 'post', 'id' => 'from-registration']) }}

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane clearfix active" id="tab-organization">
                                @include('auth.organization')
                            </div>
                            <div role="tabpanel" class="tab-pane clearfix" id="tab-users">
                                @include('auth.users')
                            </div>
                            <div role="tabpanel" class="tab-pane clearfix" id="tab-verification">
                                @include('auth.verification')
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @if(session('tab') != '#tab-verification')
                <div class="col-xs-12 col-md-12 create-account-wrapper">
                    <a href="{{ url('/auth/login') }}">@lang('global.already_have_account')</a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Registration Agency Modal -->
<div class="modal fade" id="reg_agency" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('registration.add_agency')</h4>
            </div>
            {{ Form::open(['url' => route('agency.store'), 'method' => 'post', 'id' => 'reg-agency-form']) }}
            <div class="modal-body clearfix">
                <div class="messages hidden"></div>
                <div class="form-container hidden">
                    {{--*/
                    $messages = $errors->get('name');
                    /*--}}
                    <div class="form-group {{ $messages ? ' has-error' : '' }}">
                        {{ Form::label('name', null, ['class' => 'control-label required col-xs-12 col-sm-4']) }}
                        <div class="col-xs-12 col-sm-8">
                            {{ Form::text('name',null,['class' => 'form-control']) }}
                            @foreach($messages as $message)
                                <div class="text-danger">{{ $message }}</div>
                            @endforeach
                        </div>
                    </div>
                    {{--*/
                    $messages = $errors->get('short_form');
                    /*--}}
                    <div class="form-group {{ $messages ? ' has-error' : '' }}">
                        {{ Form::label('short_form', null, ['class' => 'control-label required col-xs-12 col-sm-4']) }}
                        <div class="col-xs-12 col-sm-8">
                            {{ Form::text('short_form',null,['class' => 'form-control']) }}
                            @foreach($messages as $message)
                                <div class="text-danger">{{ $message }}</div>
                            @endforeach
                        </div>
                    </div>
                    {{--*/
                    $messages = $errors->get('website');
                    /*--}}
                    <div class="form-group {{ $messages ? ' has-error' : '' }}">
                        {{ Form::label('website', null, ['class' => 'control-label required col-xs-12 col-sm-4']) }}
                        <div class="col-xs-12 col-sm-8">
                            {{ Form::url('website',null,['class' => 'form-control']) }}
                            <p class="help-block">eg: http://www.example.com</p>
                            @foreach($messages as $message)
                                <div class="text-danger">{{ $message }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                <button type="submit" class="btn btn-primary">@lang('global.add')</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!-- Same Organization Identifier Modal -->
<div class="modal fade preventClose" id="org-identifier-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg register-container" role="document">
        <div class="modal-content form-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body text-center same-identifier">
                    <img src="{{ url('/images/ic-warning.svg') }}" alt="warning" width="81" height="66">
                    <h1>IATI @lang('organisation.organisation_identifier') @lang('global.error')</h1>
                    <p>
                        @lang('organisation.organisation_identifier_already_used')
                    </p>
                    <h2>"<span class="org-name"></span>"</h2>
                    <div class="col-md-12 identifier-information">
                        <p>@lang('organisation.please_select_appropriate_action')</p>
                        <div class="col-sm-6">
                            <h3>@lang('registration.retrieve_existing_account_details')</h3>
                            <p>
                                @lang('registration.forgotten_login_details_text')
                            </p>
                            <a href="/password/email" class="btn btn-primary">@lang('global.retrieve_login_credentials')</a>
                        </div>
                        <div class="col-sm-6">
                            <h3>@lang('registration.create_new_account')</h3>
                            <p>
                                @lang('registration.no_personal_account_contact_admin_text')
                            </p>
                            <span class="admin-name"></span>
                            <a href="{{ route('contact', ['need-new-user']) }}" class="btn btn-primary">@lang('registration.contact_your_administrator')</a>
                        </div>
                    </div>
                    <p>
                        @lang('registration.not_my_organisation')<a href="{{ route('contact', ['not-my-organization']) }}"> support@aidstream.org</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Similar Organisations Modal -->
<div class="modal fade preventClose" id="similar-org-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg register-container" role="document">
        <div class="modal-content form-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body same-identifier org-warning">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                                <span>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </span>
                        </div>
                    @endif
                    <img src="{{ url('/images/ic-warning.svg') }}" alt="warning" width="81" height="66">
                    <h1 class="text-center">@lang('registration.organisation_name_warning')</h1>
                    <p class="text-center">
                        @lang('registration.organisation_name_error_text')
                    </p>
                    <div class="input-wrapper text-center hidden">
                        @lang('registration.search_for_same_organisation_name')
                    </div>

                    {{ Form::open(['url' => route('submit-similar-organization'), 'method' => 'post', 'id' => 'similar-org-form']) }}

                    <div class="input-wrapper">
                        <div class="col-xs-12 col-md-12 hidden">
                            {{ Form::hidden('type') }}
                            {!! AsForm::text(['name' => 'search_org', 'class' => 'search_org ignore_change', 'label' => false]) !!}
                            {{ Form::button(trans('registration.search_organisation'), ['class' => 'btn btn-primary btn-search', 'type' => 'button']) }}
                            {{ Form::hidden('similar_organization') }}
                        </div>
                        <div class="org-list-container clickable-org hidden">
                            <div class="col-xs-12 col-md-12 organization-list-wrapper">
                                <p class="text-center">@lang('registration.recognise_organisation')</p>
                                <ul class="organization-list">
                                </ul>
                            </div>
                            <div class="col-md-12 text-center org-list-notification clickable-org">
                                <p>@lang('registration.none_results_match_organisation_text')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        {{ Form::button(trans('global.continue_registration'), ['class' => 'btn btn-primary btn-submit btn-register prevent-disable hidden', 'type' => 'submit', 'disabled' => 'disabled']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div id="user_template" class="hidden">
    {{--*/ $userIndex = '_index_'; /*--}}
    @include('auth.partUsers')
</div>

@include('includes.footer')

<script type="text/javascript" src="{{url('/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{url('/js/jquery.cookie.js')}}"></script>
<script type="text/javascript" src="{{url('/js/jquery.jscrollpane.min.js')}}"></script>
<script type="text/javascript" src="{{url('/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{url('/js/main.min.js')}}"></script>
<script type="text/javascript" src="{{url('/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{url('/js/registration.js')}}"></script>

<script type="text/javascript">
    var checkSimilarOrg = true;
    var checkOrgIdentifier = true;
    var agencies = JSON.parse($('.agencies').val());
    $(document).ready(function () {
        Registration.localised();
        @if($tab = session('tab'))
            checkSimilarOrg = false;
        @if($tab == '#tab-verification')
           Registration.showValidation();
        @else
           $('a[href="{{ $tab }}"]').tab('show');
        @endif
    @endif

$('form select').select2();
        $('form select').on('select2:close', function (e) {
            $(this).valid();
        });

        //        Registration.similarOrgs();
        //        Registration.sameIdentifier();
        //        Registration.disableOrgSubmitButton();
        //        Registration.disableUsersSubmitButton();
    });

    $('.country').on('select2:select', function() {
        $('.organization_registration_agency').select2({
        placeholder: "Select an Agency"
    })
});
</script>

@if(env('APP_ENV') != 'local')
    <!-- Google Analytics -->
    <script type="text/javascript" src="{{url('/js/ga.js')}}"></script>
    <!-- End Google Analytics -->
@endif
</body>
</html>
