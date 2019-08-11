@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>Manage Support</h2>
                <p>Add/Edit/Remove Content</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <h5 class="page-name">Manage Support</h5>
                    </div>
                </div>
                <form class="col-12" method="POST" action="/admin/manage_support">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="content col-12">
                            <div class="row">
                                <div class="inside">
                                    <h4 class="title">Portal Link</h4>
                                    <input type="text" name="link" value="{{$data->link}}" required>
                                    <h4 class="title">Page Content</h4>
                                    <textarea class="summernote" name="content">{!!$data->content!!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-container col-12">
                            <a href="/admin/manage_support" class="btn btn-cancel">Cancel</a>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection