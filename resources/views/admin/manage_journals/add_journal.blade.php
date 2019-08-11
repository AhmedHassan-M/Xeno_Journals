@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>Create New Journal</h2>
                <p>Add Journals</p>
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
                <form class="col-12" method="POST" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="content col-12">
                            <div class="row g-row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <h4 class="title">Journal Name</h4>
                                        <input type="text" class="text-input" name="journal_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group counter-btns">
                                        <h4 class="title">Add Volumes</h4>
                                        <button type="button" class="decrease-btn btn" disabled>
                                            <i class="fas fa-minus-circle"></i>
                                        </button>
                                        <input type="text" class="numbers_only_input volumes_count" name="volumes_count" id="volumes_count" value="1" required>
                                        <button type="button" class="increase-btn btn">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <div class="form-group">
                                        <h4 class="title">Journal Description</h4>
                                        <div class="form-group">
                                            <textarea name="journal_description" class="styled_textarea"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-container col-12">
                            <a href="admin/add-news" class="btn btn-cancel">Cancel</a>
                            <button  class="btn btn-primary">Add Journal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection