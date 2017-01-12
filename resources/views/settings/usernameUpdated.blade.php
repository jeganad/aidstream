<div class="modal fade" tabindex="-1" role="dialog" id="usernameChanged">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('setting.the_username_has_been_changed')</h4>
            </div>
            <div class="modal-body">
                <ol>
                    @foreach($users as $user)
                        @if($user->role_id != 7)
                            <li>{{$user->first_name}} {{ $user->last_name }} {{$user->username}}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">
                    <a href="{{route('settings')}}" class="btn btn-default">@lang('global.no_will_tell_them_myself')</a>
                </button>
                <button class="btn btn-primary">
                    <a href="{{route('organization-information.notify-user')}}" class="btn btn-default">@lang('global.notify')</a>
                </button>
            </div>
        </div>
    </div>
</div>