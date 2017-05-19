<div class="panel panel-default panel-element-detail element-show">
    <div class="panel-body">
        @include('Activity.partials.reportingOrganization')
        @include('Activity.partials.identifier')
        @include('Activity.partials.otherIdentifier')
        @include('Activity.partials.title')
        @include('Activity.partials.description')
        @include('Activity.partials.activityStatus')
        @include('Activity.partials.activityDate')
        @include('Activity.partials.contactInfo')
        @include('Activity.partials.activityScope')
        @include('Activity.partials.participatingOrganization')
        @include('Activity.partials.recipientCountry')
        @include('Activity.partials.recipientRegion')
        @include('Activity.partials.location')
        @include('Activity.partials.sector')
        @include('Activity.partials.policyMarker')
        @include('Activity.partials.collaborationType')
        @include('Activity.partials.defaultFlowType')
        @include('Activity.partials.defaultFinanceType')
        @include('Activity.partials.defaultAidType')
        @include('Activity.partials.defaultTiedStatus')
        @include('Activity.partials.countryBudgetItem')
        @if(!empty($humanitarianScopes))
            @include('Activity.partials.humanitarianScope')
        @endif
        @include('Activity.partials.budget')
        @include('Activity.partials.plannedDisbursement')
{{--        @include('Activity.partials.transaction')--}}
        @include('Activity.partials.capitalSpend')
        @include('Activity.partials.documentLink')
        @include('Activity.partials.relatedActivity')
        @include('Activity.partials.condition')
{{--        @include('Activity.partials.result')--}}
        @include('Activity.partials.legacyData')
    </div>
</div>
