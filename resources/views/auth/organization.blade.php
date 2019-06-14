<div class="registration-inner-wrapper">
    <div class="text-wrapper">
        <h2>@lang('organisation.organisation_information')</h2>
        <p>@lang('organisation.organisation_information_text')</p>
    </div>
    <div class="input-wrapper">
        <div class="choose-wrapper">
            @foreach($systemVersions as $id => $version)
                <div class="choose-option pull-left">
                    <input type="radio" value="{{$id}}" {{($id == $systemVersion) ? 'checked' : ($id == 1) ? 'checked' : ''}} name="systemVersion"/><span>{{$version}}</span>
                    <p>@lang(sprintf('organisation.%s', $version))</p>
                </div>
            @endforeach
        </div>
        <div class="col-xs-12 col-md-12">
            {!! AsForm::text(['name' => 'organization[organization_name]', 'label' => trans('organisation.organisation_name'), 'class' => 'organization_name', 'required' => true, 'parent' => 'col-xs-12 col-sm-6 col-md-6', 'html' => '<span class="availability-check hidden"></span>']) !!}
            {!! AsForm::text(['name' => 'organization[organization_name_abbr]', 'class' => 'organization_name_abbr', 'label' => trans('organisation.organisation_name_abbreviation'), 'help' => 'registration_org_name_abbr', 'required' => true, 'parent' => 'col-xs-12 col-sm-6 col-md-6', 'html' => '<span class="availability-check hidden"></span>']) !!}
        </div>
        <div class="col-xs-12 col-md-12">
            {!! AsForm::select(['name' => 'organization[organization_type]', 'label' => trans('organisation.organisation_type'), 'class' => 'organization_type', 'data' => $orgType, 'required' => true , 'parent' => 'col-xs-12 col-sm-6 col-md-6', 'empty_value' => trans('global.select_a_type')]) !!}
            @if(isTzSubDomain())
                {!! AsForm::select(['name' => 'organization[country]', 'value' => 'TZ','label' => trans('organisation.organisation_country'), 'class' => 'country', 'data' => ['TZ' => getVal($countries,['TZ'])], 'required' => true , 'parent' => 'col-xs-12 col-sm-6 col-md-6', 'empty_value' => trans('global.select_a_country')]) !!}
            @else
                {!!  AsForm::select(['name' => 'organization[country]', 'label' => trans('organisation.organisation_country'), 'class' => 'country', 'data' => $countries, 'required' => true , 'parent' => 'col-xs-12 col-sm-6 col-md-6','empty_value' => trans('global.select_a_country')]) !!}
            @endif
        </div>
        <div class="col-xs-12 col-md-12">
            {!! AsForm::text(['name' => 'organization[organization_address]', 'label' => trans('organisation.organisation_address'), 'class' => 'organization_address', 'required' => true, 'parent' => 'col-xs-12 col-sm-6 col-md-6']) !!}
            {!! AsForm::select(['name' => 'organization[organization_registration_agency]', 'label' => trans('organisation.organisation_registration_agency'), 'class' => 'organization_registration_agency', 'data' =>$orgRegAgency, 'required' => true , 'parent' => 'col-xs-12 col-sm-6 col-md-6', 'empty_value' => trans('global.select_an_agency'), 'html' => sprintf('<button type="button" class="btn-xs btn-link add_agency">%s</button>', trans('global.add_agency'))]) !!}
            {{ Form::hidden('organization[agencies]', ($agencies = getVal($regInfo, ['organization', 'agencies'], [])) ? $agencies : json_encode($orgRegAgency), ['class' => 'form-control agencies', 'id' => 'agencies', 'data-agency' => getVal($regInfo, ['organization', 'organization_registration_agency'])]) }}
            {{ Form::hidden('organization[new_agencies]', null, ['class' => 'form-control new_agencies', 'id' => 'organization[new_agencies]']) }}
            {{ Form::hidden('organization[agency_name]', null, ['class' => 'form-control agency_name', 'id' => 'organization[agency_name]']) }}
            {{ Form::hidden('organization[agency_website]', null, ['class' => 'form-control agency_website', 'id' => 'organization[agency_website]']) }}
        </div>
        <div class="col-xs-12 col-md-12">
            {!! AsForm::text(['name' => 'organization[registration_number]', 'class' => 'registration_number', 'label' => trans('organisation.registration_number'), 'required' => true, 'parent' => 'col-xs-12 col-sm-6 col-md-6']) !!}
            {!! AsForm::text(['name' => 'organization[organization_identifier]', 'help' => 'registration_org_identifier', 'label' => trans('organisation.organisational_iati_identifier'), 'class' => 'organization_identifier', 'id' => 'organization[organization_identifier]', 'required' => true, 'parent' => 'col-xs-12 col-sm-6 col-md-6', 'attr' => ['readonly' => 'readonly']]) !!}
        </div>
    </div>
</div>
{{ Form::button(trans('global.continue_registration'), ['class' => 'btn btn-primary btn-submit btn-register btn-tab pull-right', 'type' => 'button',  'data-tab-trigger' => '#tab-users']) }}
