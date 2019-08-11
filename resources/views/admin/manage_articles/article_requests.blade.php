@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>New Article Requests</h2>
                <p>From this section, you will get all the information about new Articles Request</p>
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
                                    <th>Submitted at</th>
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
                                        <p>{{date("d / m / Y", strtotime($article->created_at))}}</p>
                                    </td>
                                    <td>
                                        <p>
                                            @if($article->status > 1)
                                            <button class="btn btn-primary" disabled>Start Revision</button>
                                            @else
                                            @if($article->status == 0)
                                            <a href="#" onclick="showArticle({{$article}})" data-toggle="modal" data-target="#articleRequestModal" class="btn btn-primary">Start Revision</a>
                                            @elseif($article->status == 1)
                                            <a href="#" onclick="showArticle({{$article}})" data-toggle="modal" data-target="#articleRequestModal" class="btn btn-primary">Continue Revision</a>
                                            @endif
                                            @endif
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
        @include('layouts.inc.admin_articleRequest_modal')
@endsection
@section('scripts')
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

                if(data == 'success'){
                    window.location.href="/admin/articles/requests";
                }
                
            },
            error: function (data) {
                console.log('error');
            }
        });
    }

    function showArticle(article) {
        console.log(article);
        let url = `/data-entry/start-revision/${article.id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });

        //Personal Info
        $('#affiliation_text').html(article.user.affiliation);
        $('#degree_text').html(article.user.degree);
        $('#firstname_text').html(article.user.first_name);
        $('#correspondingAuthor_text').html(article.corresponding_author);
        $('#lastname_text').html(article.user.last_name);
        $('#submission_date').text(article.created_at);

        //Authors Info
        var authors = article.author;
        $('#pills-author_info').empty();
        authors.forEach(author => {
            const authorSec = `<div class="col-12">
                                        <div class="row">
                                            <div class="item col-12">
                                                <h5 class="title">Author Name</h5>
                                                <p class="text" id="details_name_text">${author.name}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="item col-12">
                                                <h5 class="title">Author Title</h5>
                                                <p class="text" id="details_title_text">${author.title}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="item col-12">
                                                <h5 class="title">Affiliation</h5>
                                                <p class="text" id="details_affiliation_text">${author.affiliation}</p>
                                            </div>
                                        </div>
                                    </div>`;

            $('#pills-author_info').append(authorSec);

        });

        //Article Info
        $('#details_type_text').html(article.type);
        $('#details_abstract_text').html(article.abstract);
        $('#details_keywords_text').html(article.keywords);
        $('#details_intro_text').html(article.intro);
        $('#details_addInfo_text').html(article.additional_info);
        $('#details_reference_text').html(article.reference);
        $("#word_file").attr("href",`/uploads/files/${article.word_file}`);
        $("#figure").attr("href",`/uploads/images/${article.figures}`);
        $("#excel_sheet").attr("href",`/uploads/files/${article.excel_sheet}`);
        $("#author_conflict").attr("href",`/uploads/files/${article.author_conflict}`);
        $("#financial_disclosure_file").attr("href",`/uploads/files/${article.financial_disclosure_file}`);
        $('#financial_disclosure').html(article.financial_disclosure);
        $('#details_ethics_text').html(article.ethics_community);
        // $( "#pills-author_info" ).clone().appendTo( "#authors-area" ).removeClass('d-none');
        // $('#details_name_text').html(author.name);

        $('#article_id').val(article.id);
        $('#rejected_article_id').val(article.id);
        
    }

    $("#select_journal").on("change", () => {
        // var selectedJournal = $(this).children("option:selected").val();
        var selectedJournalString = $( "#select_journal" ).val();

        var selectedJournal = JSON.parse(selectedJournalString);
        $('#select_volume').empty();
        $( '#select_volume' )
        .find('option')
        .remove()
        .end();

        $('#select_volume').append('<option value="" selected disabled>Select Volume</option>');
        for(var i = 1 ; i <= selectedJournal.volumes ; i++){
            console.log(selectedJournal);
            $('#select_volume')
                    .append($("<option></option>")
                    .attr("value",i)
                    .text('Volume '+i));
        }
        $('#select_volume').selectpicker('refresh');
        
    });

    $('#approve_step').on('submit' , (e) => {
        e.preventDefault();

        var form = $('#approve_step');

        $.ajax({
            type: 'POST',
            url: '/admin/approve-article',
            data: form.serialize(),
            success: function success(response) {
                console.log(response);

                if(response == 'success'){
                    location.reload();
                }
                
            },
            error: function error(e) {
                console.log(e);
            }
        });
    });

    $('#reject_step').on('submit' , (e) => {
        e.preventDefault();

        var form = $('#reject_step');

        $.ajax({
            type: 'POST',
            url: '/admin/reject-article',
            data: form.serialize(),
            success: function success(response) {
                console.log(response);

                if(response == 'success'){
                    window.location.href="/articles/rejected-successfully";
                }
                
            },
            error: function error(e) {
                console.log(e);
            }
        });
    });
</script>
@endsection