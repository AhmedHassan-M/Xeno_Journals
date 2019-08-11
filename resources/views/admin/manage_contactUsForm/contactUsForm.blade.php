@extends('layouts.master_admin')

@section('content')
  <div class="page-header col-12">
            <div class="row">
                <h2>Manage Contact Us Form</h2>
                <p>From this section, you can manage all Form from website visitor</p>
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
                        <table id="allJournalsTable" class="display f-14-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Affiliatin</th>
                                    <th>Subject</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allContactUs as $contact)
                                <tr> 
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select-checkbox" id="{{$contact->id}}">
                                            <input type="hidden" name="id" value="{{$contact->id}}">
                                            <label class="custom-control-label" for="{{$contact->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$contact->affiliation}}</p>
                                    </td>
                                    <td>
                                        <p>{{$contact->subject}}</p>
                                    </td>
                                    <td>
                                        <p>{{$contact->name}}</p>
                                    </td>
                                    <td>
                                        <p>{{$contact->email}}</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="#" onclick="showContactDetails({{$contact}})" data-toggle="modal" data-target="#viewJournalModal" class="show-more-btn">Show More</a>
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
        @include('layouts.inc.admin_contactForm_modal')
@endsection
<script>
    function submitHandler() {
        const url ='/admin/delete_contacts' ;
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
                window.location.href="/admin/contact_form";
            },
            error: function (data) {
                console.log('error');
            }
        });
    }

    function showContactDetails(contact){
        $('#affiliatin_text').html(contact.affiliation);
        $('#subject_text').html(contact.subject);
        $('#name_text').html(contact.name);
        $('#email_text').html(contact.email);
        $('#details_text').html(contact.details);
    }
</script>