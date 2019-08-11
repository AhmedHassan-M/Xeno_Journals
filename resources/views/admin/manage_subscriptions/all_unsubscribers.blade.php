@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>Manage Unsubscriptions</h2>
                <p>Add/Edit/Remove Content</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <h5 class="page-name">All Unsubscribers</h5>
                    </div>
                </div>
                <form action="" class="col-12">
                    {{csrf_field()}}
                    <div class="table-content">
                        <div class="actions-div d-none">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="select-all-checkbox" id="selectAllCheck" value="all-checked">
                                <label class="custom-control-label" for="selectAllCheck">
                                    <span id="select-all-text">Select All</span> (<span id="selectedCount">0</span>)
                                </label>
                            </div>
                        </div>
                        <table id="subscribersTable" class="display f-14-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Unsubscribers as $Unsubscriber)
                                <tr> 
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select-checkbox" id="check{{$Unsubscriber->id}}">
                                            <input type="hidden" name="id" value="{{$Unsubscriber->id}}">
                                            <label class="custom-control-label" for="check{{$Unsubscriber->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$Unsubscriber->unsubscribed}}</p>
                                    </td>
                                    <td>
                                        <p>{{date("d/m/Y",strtotime($Unsubscriber->created_at))}}</p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
@endsection