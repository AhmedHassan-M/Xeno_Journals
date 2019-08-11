@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>Manage Subscriptions</h2>
                <p>Add/Edit/Remove Content</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <h5 class="page-name">All Subscribers</h5>
                    </div>
                </div>
                <?php $data = DB::table('subscribes')->get(); ?>
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
                            <select class="custom-select" id="select-options" disabled>
                                <option value="0" selected disabled>More</option>
                                <option value="2">Delete</option>
                            </select>
                            <div class="button">
                                <button type="button" onClick="submitHandler()" class="btn">Apply</button>
                            </div>
                        </div>
                        <table id="subscribersTable" class="display f-14-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr> 
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select-checkbox" id="check{{$item->id}}">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <label class="custom-control-label" for="check{{$item->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$item->subscribe}}</p>
                                    </td>
                                    <td>
                                        <p>{{date("d/m/Y",strtotime($item->created_at))}}</p>
                                    </td>
                                    <td>
                                        <p><a href="/admin/subscribe_delete_index/{{$item->id}}" class="btn btn-danger">Delete</a></p>
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
        const url ='/admin/subscribe_delete' ;
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
                    window.location.href="/admin/manage_subscriptions/all_subscribers";
           },
            error: function (data) {
                console.log('error');
            }
        });
    }
</script>