@extends('layouts.master_admin')

@section('content')
  <div class="page-header col-12">
            <div class="row">
                <h2>Contact us page</h2>
                <p>From this section, you can manage Contact us page</p>
            </div>
        </div>
        <div class="page-content col-12">
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
            <form method="POST" class="col-12 content">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group p-title">
                                <h4 class="title-contact">Page title</h4>
                                <input name="title" type="text" value=" @if(isset($contactUsContent)) {{$contactUsContent->title}} @endif " placeholder="Lorem ipsum" class="form-control page-title" required>
                            </div>
                            <div class="form-group p-content">
                                <h4 class="title-contact">Page Content</h4>
                                 <textarea class="summernote" name="editordata" required> @if(isset($contactUsContent)) {{$contactUsContent->content}} @endif </textarea>
                            </div>
                            <div class="form-group p-location">
                                <h4 class="title-contact">Location</h4>
                                <input name="location" type="text" value=" @if(isset($contactUsContent)) {{$contactUsContent->location}} @endif " placeholder="Lorem ipsum" class="form-control page-title" required>
                            </div>
                            <div class="form-group">
                                <h4 class="title-contact">Email</h4>
                                <input name="email" type="email" value=" @if(isset($contactUsContent)) {{$contactUsContent->email}} @endif " placeholder="Lorem ipsum" class="form-control page-title" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button type="reset" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
@endsection