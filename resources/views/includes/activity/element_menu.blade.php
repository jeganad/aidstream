@inject('defaultFieldGroups', 'App\Helpers\DefaultFieldGroups')

{{--*/
$fieldGroups = $defaultFieldGroups->get();
$filledStatus = $defaultFieldGroups->getFilledStatus($id);
/*--}}
<div class="element-sidebar-wrapper">
    @foreach($fieldGroups as $fieldGroupIndex => $fieldGroup)
        <div class="panel panel-default">
            <div class="panel-heading">{{$fieldGroupIndex}}</div>
            <div class="panel-body">
                <ul class="nav">
                    @foreach($fieldGroup as $fieldIndex => $field)
                        <li>
                            {{--*/ $filled = $filledStatus[$fieldGroupIndex][$fieldIndex]; /*--}}
                            <a href="{{ route(sprintf('activity.%s.index', str_replace('_', '-', $fieldIndex)), [$id]) }}" class="{{ $filled ? 'active' : '' }}">
                                <span class="action-icon {{ $filled ? 'edit-value' : 'add' }}">icon</span>
                                {{$field}}
                            </a>
                            <span class="help-text" data-toggle="tooltip" data-placement="top" title="@lang(session()->get('version') . '/help.Activity_' . $fieldIndex)">help text</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
