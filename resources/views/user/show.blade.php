@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        @if($errors->any())
            <div class="alert alert-danger text-center mt-2" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        <div class="card col-12 col-md-8 col-lg-7 col-xl-6 px-0 mx-auto">
            <h4 class="card-header bg-green text-white text-center">
                Profile Overview
            </h4>
            <div class="px-0 card-body col-12 mx-auto text-center mb-0 pb-0 mx-0">
                <div>
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('avatars/'.$user->id.'.jpg'))
                        <img src="{{\Illuminate\Support\Facades\Storage::url('avatars/'.$user->id.'.jpg')}}" style="width: 80px" class="mx-1 rounded-circle mx-auto" alt="Avatar">
                    @endif
                    <span class="mx-3" style="font-size: 150%">{{$user->name}}</span>
                </div>
                    <h5 class="mt-2 font-weight-bold text-green">Statistics</h5>
                    <table class="table col-12 col-md-8 mx-auto">
                        <tr>
                            <th colspan="2" class="bg-gray font-weight-bold text-center">Organized:</th>
                        </tr>
                        <tr>
                            <th>Rides (Past/Upcoming)</th>
                            <td class="text-left">{{$stats->createdPastRides.' / '.$stats->createdUpcomingRides}}</td>
                        </tr>
                        <tr>
                            <th>Races (Past/Upcoming)</th>
                            <td class="text-left">{{$stats->createdPastRaces.' / '.$stats->createdUpcomingRaces}}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-gray font-weight-bold">Participated:</th>
                        </tr>
                        <tr>
                            <th>Rides (Past/Upcoming)</th>
                            <td class="text-left">{{$stats->participatedPastRides.' / '.$stats->participatedUpcomingRides}}</td>
                        </tr>
                        <tr>
                            <th>Races (Past/Upcoming)</th>
                            <td class="text-left">{{$stats->participatedPastRaces.' / '.$stats->participatedUpcomingRaces}}</td>
                        </tr>
                    </table>
                <button class="btn btn-primary btn-lg btn-block mt-3 mb-0 mx-0">Follow</button>
            </div>
        </div>
            @if($organizing->count()>0)
                @php
                $iteration=0;
                @endphp
                <div class="card col-12 col-md-11 col-lg-10 col-xl-8  px-0 mt-4 mx-auto">
            <h5 class="card-header bg-green text-white text-center">Organizing</h5>
            <div class="card-body bg-gray pt-0">
                {{--5 CREATED EVENTS--}}
                @foreach($organizing as $event)
                    @include('events.components.view_event_card',['event'=>$event, 'loop'=>$iteration++])
                @endforeach
            </div>
        </div>
            @endif
            @if($participating->count()>0)
                <div class="card col-12 col-md-11 col-lg-10 col-xl-8 px-0 mt-3 mx-auto">
                <h5 class="card-header bg-green text-white text-center">Participating in</h5>
                <div class="card-body bg-gray pt-0">
                    {{--5 UPCOMING PARTICIPATING--}}
                    @foreach($participating as $event)
                        @include('events.components.view_event_card',['event'=>$event, 'loop'=>$iteration++])
                    @endforeach
                </div>
            </div>
                @endif


    </div>
@endsection
