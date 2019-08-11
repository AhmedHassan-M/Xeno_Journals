@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>All Notifications</h2>
                <p>In this page, you can view all your notifications</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                <ul class="all-notification">
                    <div class="all-notification__content">
                        @foreach($notifications as $notification)
                        <li>
                            <a class="app-notification__item" href="{{$notification->url}}">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        @if($notification->type == 'contact')
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                        @elseif($notification->type == 'warning')
                                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                        <i class="far fa-hdd fa-stack-1x fa-inverse"></i>
                                        @elseif($notification->type == 'success')
                                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                                        <i class="fas fa-coins fa-stack-1x fa-inverse"></i>
                                        @endif
                                    </span>
                                </span>
                                <div>
                                    <p class="app-notification__message">{{$notification->text}}</p>
                                    <p class="app-notification__meta">{{timeago($notification->created_at)}}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>
@endsection

@section('scripts')

@endsection