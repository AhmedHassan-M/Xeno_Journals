@extends('layouts.master_admin')

@section('content')
    <div class="page-header col-12">
        <div class="row">
            <h2>Create New Page</h2>
            <p>From this section, you can create new pages in about xeno section</p>
        </div>
    </div>
    <div class="page-content col-12">
        <div class="row">
            <form action="" class="col-12">
            {{ csrf_field() }}
                <div class="table-content">
                    <div class="actions-div d-none">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="select-all-checkbox" id="selectAllCheck" value="all-checked">
                            <label class="custom-control-label" for="selectAllCheck">
                                <span id="select-all-text">Select All</span> (<span id="selectedCount">0</span>)
                            </label>
                        </div>
                        <select class="custom-select" id="select-options" disabled>
                            <option value="0" selected disabled>More</option>
                            <option value="1">Edit</option>
                            <option value="2">Delete</option>
                        </select>
                        <div class="button">
                            <button type="button" onClick="submitHandler()" class="btn">Apply</button>
                        </div>
                    </div>
                    <table id="articleRequestsTable" class="display f-14-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Affiliation</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Article Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                            <tr> 
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="select-checkbox" id="check{{$article->id}}">
                                        <input type="hidden" name="id" value="{{$article->id}}">
                                        <label class="custom-control-label" for="check{{$article->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p>{{$article->user->affiliation}}</p>
                                </td>
                                <td>
                                    <p>{{$article->user->first_name}}</p>
                                </td>
                                <td>
                                    <p>{{$article->user->last_name}}</p>
                                </td>
                                <td>
                                    <p>{{$article->type}}</p>
                                </td>
                                <td>
                                    @if($article->status == 2)
                                    <p class="red-status">To Do</p>
                                    @elseif($article->status == 3)
                                    <p class="yellow-status">In Progress</p>
                                    @elseif($article->status == 3.5)
                                    <p class="green-status">Need Publish Permission</p>
                                    @endif
                                </td>
                                <td>
                                    <p>
                                        <a href="#" onclick="showArticle({{$article}})" data-toggle="modal" data-target="#assignedArticleModal" class="show-more-btn">Show More</a>
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.inc.admin_assignedArticle_modal')
@endsection