@extends('layouts.master_admin')

@section('content')
  <div class="page-header col-12">
            <div class="row">
                <h2>All Data Entry</h2>
                <p>From this section, you can manage all data entry</p>
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allDataEntries as $DataEntry)
                                <tr> 
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select-checkbox" id="{{$DataEntry->id}}">
                                            <input type="hidden" name="id" value="{{$DataEntry->id}}">
                                            <label class="custom-control-label" for="{{$DataEntry->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$DataEntry->name}}</p>
                                    </td>
                                    <td>
                                        <p>{{$DataEntry->email}}</p>
                                    </td>
                                    <td>
                                        <p>{{date("d/m/Y",strtotime($DataEntry->created_at))}}</p>
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
<script>
    function submitHandler() {
        const url ='/admin/Data_entry_delete' ;
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
        //console.log(changed);
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
                window.location.href="/admin/data-entry/all-data";
            },
            error: function (data) {
                console.log('error');
            }
        });
    }
</script>