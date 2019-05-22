@extends('app')

@section('title', 'Organisations')

@section('content')
    <style>
        .less-description {
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 100px;
            white-space: nowrap;
        }
    </style>
    <div class="container main-container admin-container">
        <div class="row">
            <div class="panel-content-heading">
                <div>Organisations</div>
            </div>
            <div class="col-xs-12 col-lg-8 organization-wrapper">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(count($organizations) > 0)
                            <table class="table table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th width="100px">S.N.</th>
                                        <th width="30%">Organisation Name</th>
                                        <th>Version</th>
                                        <th>Users</th>
                                        <th>Activities</th>
                                        <th width="180px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($organizations as $key=>$organization)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="less-description">{{ $organization->name}}
                                                <div>{{getVal($organization->users->toArray(), [0, 'email'])}}</div>
                                            </td>
                                            <td>{{ $organization->settings ? $organization->settings->version : '' }}</td>
                                            <td>{{ count($organization->users) }}</td>
                                            <td>{{ count($organization->activities) }}</td>
                                            <td>
                                                <div class="organization_actions">
                                                    @if(session('role_id') == 3)
                                                        <a href="{{ route('admin.hide-organization', [$organization->id,($organization->display) ? 0 : 1 ]) }}"
                                                        title="{{($organization->display) ? 'Hide' : 'Show'}}"
                                                        class="display {{($organization->display) ? 'Yes' : 'No'}}">{{($organization->display) ? 'Yes' : 'No'}}</a>
                                                        <a href="{{ route('admin.edit-organization', $organization->id)}}"
                                                        class="edit" title="Edit">@lang('global.edit')</a>
                                                        <a href="{{ route('admin.change-organization-status', [$organization->id, ($organization->status) ? 0 : 1]) }}"
                                                        class="check-status {{($organization->status) ? 'Disable' : 'Enable'}}"
                                                        title="{{($organization->status) ? 'Disable' : 'Enable'}}">{{($organization->status == 1) ? 'Disable' : 'Enable'}}</a>
                                                        <a href="{{ route('admin.delete-organization', $organization->id) }}" class="delete" title="delete">Delete</a>
                                                    @endif
                                                    @if (getVal($organization->users->toArray(), [0], false))
                                                        <a href="{{ route('admin.masquerade-organization',
                                                        [$organization->id, getVal($organization->users->toArray(), [0], false) ?
                                                        getVal($organization->users->toArray(), [0, 'id']) :
                                                        $organization->users()->first()->id]) }}"
                                                        class="masquerade" title="Masquerade">Masquerade</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center no-data">No Organisation Registered Yet ::</div>
                        @endif
                    </div>
                </div>
            </div>
            @include('includes.superAdmin.side_bar_menu')
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
        $('#data-table').DataTable();
        $('#data-table_length').addClass('pull-right');
        $('#data-table_filter').addClass('pull-left');
    });
    </script>
    <script type="text/javascript">
        var masqueradeBtn = document.querySelectorAll('.masquerade');

        var preventClick = false;
        for (var i = 0; i < masqueradeBtn.length; i++) {
            var button = masqueradeBtn[i];
            button.onclick = function (event) {
                if (preventClick) {
                    event.preventDefault();
                }
                preventClick = true;
            }
        }
    </script>
@stop
