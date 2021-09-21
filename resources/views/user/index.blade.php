@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        @if($errors->any())
            <div class="alert alert-danger text-center mt-2" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        <form class="card card-body col-12 col-md-8 col-xl-6 mx-auto" action="{{route('users.find')}}" method="GET">
            @csrf @method('GET')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" minlength="3" maxlength="50" required class="form-control" id="name" name="name" value="{{old('name')}}">
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-green">Search</button>
        </form>
            {{--RESULTS--}}
    @isset($users)
        @if($users->count()===0)
                    <div class="alert alert-warning text-center mt-4 col-12 col-md-8 col-lg-6 mx-auto" role="alert">
                        No users found
                    </div>
            @else
        <table class="table mx-auto bg-white mt-3 text-center col-12 col-md-8 col-lg-6">
            <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Follow</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>@if(\Illuminate\Support\Facades\Storage::disk('public')->exists('avatars/'.$user->id.'.jpg'))
                            <img src="{{\Illuminate\Support\Facades\Storage::url('avatars/'.$user->id.'.jpg')}}" style="width: 40px" class="mx-1 rounded-circle" alt="Avatar">
                        @endif</td>
                    <td class="align-middle"><a href="{{route('users.show',$user)}}">{{$user->name}}</a></td>
                    <td class="align-middle">
                            <button type="button" id="follow-{{$user->id}}" onclick="follow({{$user->id}})" class="btn btn-sm btn-primary @cannot('follow',$user) d-none @endcannot">Follow</button>
                        <button type="button" id="unfollow-{{$user->id}}" onclick="unfollow({{$user->id}})" class="btn btn-sm btn-outline-primary @cannot('unfollow',$user) d-none @endcannot">Unfollow</button>
                    </td>
                </tr>
                @endforeach
        </table>
            @endif
            @endisset

    </div>

    <script type="text/javascript" src="{{asset('js/followUsers.js')}}"></script>
    @endsection
