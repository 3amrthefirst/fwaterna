<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary pull-right" href="#"><i
                class="fa fa-bars"></i> </a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            {{-- @inject('contacts',App\Models\Contact)
            @php
                $contactsCount =$contacts->where('answer','=',null)->pluck('id')->count();
            @endphp --}}
            {{-- <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-comment" style="font-size: 1.5em" data-toggle="tooltip" title="{{__("اﻹستشارات")}}"></i>
                    <span class="label label-danger" style="margin-top: -5px;margin-right: -2px">{{$contactsCount}}</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts" style="margin-right: -55px;">
                    @if($contactsCount != 0)
                        @foreach($contacts->where('answer','=',null)->latest()->paginate(5) as $contact)
                            <li>
                                <a href="{{ route('contacts.index') }}" class="dropdown-item">
                                    <div>
                                        {{__('إستشارة جديدة في مجال')}}
                                        <span class="label label-info">{{$contact->business}}</span>
                                    </div>
                                    <span class="float-right text-muted small">
                                        {{\Carbon\Carbon::parse($contact->created_at)}}
                                        </span>
                                </a>
                            </li>
                        @endforeach
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="{{url('admin/contacts')}}" class="dropdown-item">
                                    <strong>{{__('مشاهدة الكل')}}</strong>
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </div>
                        </li>
                    @else
                        <li>
                            <div class="text-center link-block">
                                    <strong>{{__('لا توجد إستشارات جديدة')}}</strong>
                            </div>
                        </li>
                    @endif
                </ul>
            </li> --}}

            {{-- @endcan --}}
            <li>
                <script type="">
                    function submitSignout(){
                        document.getElementById('signoutForm').submit();
                    }
                </script>
                {!! Form::open(['method' => 'post', 'url' => url('admin/admin-logout'),'id'=>'signoutForm']) !!}
                {!! Form::hidden('guard','admin') !!}
                {!! Form::close() !!}
                <a href="#" onclick="submitSignout()">
                    <i class="fa fa-sign-out-alt"></i> تسجيل الخروج
                </a>
            </li>


        </ul>

    </nav>
</div>
