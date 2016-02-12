@if(!empty($contactInfo))
    <div class="panel panel-default">
        <div class="panel-heading">Contact Info
            <a href="{{route('activity.contact-info.index', $id)}}" class="edit-element">edit</a>
        </div>
        <div class="panel-body panel-element-body">
            @foreach($contactInfo as $info)
                <div class="col-xs-12 col-md-12">
                    <div class="col-xs-12 col-sm-4">Type: </div>
                    <div class="col-xs-12 col-sm-8">{{ $getCode->getActivityCodeName('ContactType', $info['type']) }}</div>
                </div>
                @foreach($info['organization'] as $organization)
                    @foreach($organization['narrative'] as $narrative)
                        <div class="col-xs-12 col-md-12">
                            <div class="col-xs-12 col-sm-4">Organization Name: </div>
                            <div class="col-xs-12 col-sm-8">{{$narrative['narrative'] . ' [' . $getCode->getOrganizationCodeName('Language', $narrative['language']) . ']'}}</div>
                        </div>
                    @endforeach
                @endforeach
                @foreach($info['department'] as $department)
                    @foreach($department['narrative'] as $narrative)
                        <div class="col-xs-12 col-md-12">
                            <div class="col-xs-12 col-sm-4">Department: </div>
                            <div class="col-xs-12 col-sm-8">{{$narrative['narrative'] . ' [' . $getCode->getOrganizationCodeName('Language', $narrative['language']) . ']'}}</div>
                        </div>
                    @endforeach
                @endforeach
                @foreach($info['person_name'] as $person_name)
                    @foreach($person_name['narrative'] as $narrative)
                        <div class="col-xs-12 col-md-12">
                            <div class="col-xs-12 col-sm-4">Person Name: </div>
                            <div class="col-xs-12 col-sm-8">{{$narrative['narrative'] . ' [' . $getCode->getOrganizationCodeName('Language', $narrative['language']) . ']'}}</div>
                        </div>
                    @endforeach
                @endforeach
                @foreach($info['job_title'] as $job_title)
                    @foreach($job_title['narrative'] as $narrative)
                        <div class="col-xs-12 col-md-12">
                            <div class="col-xs-12 col-sm-4">Job Title: </div>
                            <div class="col-xs-12 col-sm-8">{{$narrative['narrative'] . ' [' . $getCode->getOrganizationCodeName('Language', $narrative['language']) . ']'}}</div>
                        </div>
                    @endforeach
                @endforeach
                @foreach($info['telephone'] as $telephone)
                    <div class="col-xs-12 col-md-12 clearfix">
                        <div class="col-xs-12 col-sm-4">Telephone: </div>
                        <div class="col-xs-12 col-sm-8">{{$telephone['telephone']}}</div>
                    </div>
                @endforeach
                @foreach($info['email'] as $email)
                    <div class="col-xs-12 col-md-12 clearfix">
                        <div class="col-xs-12 col-sm-4">Email: </div>
                        <div class="col-xs-12 col-sm-8">{{$email['email']}}</div>
                    </div>
                @endforeach
                @foreach($info['website'] as $website)
                    <div class="col-xs-12 col-md-12 clearfix">
                        <div class="col-xs-12 col-sm-4">Website: </div>
                        <div class="col-xs-12 col-sm-8">{{$website['website']}}</div>
                    </div>
                @endforeach
                @foreach($info['mailing_address'] as $mailing_address)
                    @foreach($mailing_address['narrative'] as $narrative)
                        <div class="col-xs-12 col-md-12 clearfix">
                            <div class="col-xs-12 col-sm-4">Job Title: </div>
                            <div class="col-xs-12 col-sm-8">{{$narrative['narrative'] . ' [' . $getCode->getOrganizationCodeName('Language', $getCode->getOrganizationCodeName('Language', $narrative['language'])) . ']'}}</div>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>
@endif
