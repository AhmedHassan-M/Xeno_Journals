@extends('layouts.master_dataEntry')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>New Article Requests</h2>
                <p>From this section, you will get all the information about new Articles Request</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                @if(session()->has('failure'))
                    <div class="alert alert-danger">
                        {{ session()->get('failure') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="" class="col-12" enctype="multipart/form-data">
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
                                    <th>Approved at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                <tr> 
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select-checkbox" id="check(id)">
                                            <input type="hidden" name="id" value="(id)">
                                            <label class="custom-control-label" for="check(id)"></label>
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
                                        <p>{{date("d / m / Y", strtotime($article->assigned_at))}}</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="#" onclick="showDataEntryArticle({{$article}})" data-toggle="modal" data-target="#dataEntryArticleRequestModal" class="btn btn-primary">Start Revision</a>
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
        @include('layouts.inc.dataEntry_articleRequest_modal')
@endsection
<script>
    function submitHandler() {
        const url ='/admin/article_delete' ;
        const _token = $('input[name="_token"]').val();
        const apply = $( "#select-options option:selected" ).text();
        let changed = [];
        $('.selected').each(function () {
            changed.push(
                {
                    id: $(this).find('input[name="id"]').val(),
                }
            );
        });
        console.log(changed);
        $.ajax({
           headers: { 
               "X-CSRF-TOKEN" : _token
           },
            type: 'POST',
            url: url,
            data: { 
                changed : changed,
                apply : apply
                },
            success: function (data) {
                console.log(data);
                window.location.href="/admin/articles/requests";
            },
            error: function (data) {
                console.log('error');
            }
        });
    }


    function sendToAdmin() {
        let id = $('#article_id').val();
        let url = `/data-entry/send-to-publish/${id}`;
        $.ajax({
            type: 'get',
            url: url,
            success: function (data) {
                window.location.href="/data_entry/sent_to_admin";
            },
            error: function (data) {
                console.log('error');
            }
        });
    }
</script>