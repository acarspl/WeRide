<button class="btn-block btn btn-outline-primary mb-2 @can('join',$event) d-block @else d-none @endcan" @if($event->isRace)
id="join_event_button_{{$event->id}}_r" @else id="join_event_button_{{$event->id}}" @endif
onclick="joinEvent('{{$event->id}}','{{$event->isRace}}')">Join</button>

        <button class="btn-block btn btn-primary mb-2 @cannot('join',$event) @if($event->doesUserParticipate(\Illuminate\Support\Facades\Auth::user())) d-block @else d-none @endif @else d-none @endcannot"
                @if($event->isRace) id="leave_event_button_{{$event->id}}_r" @else id="leave_event_button_{{$event->id}}" @endif
                onclick="leaveEvent('{{$event->id}}','{{$event->isRace}}')">Joined</button>

<script src="{{asset('js/joinEvent.js')}}"></script>
