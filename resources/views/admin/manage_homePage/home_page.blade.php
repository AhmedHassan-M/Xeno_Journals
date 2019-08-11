@extends('layouts.master_admin')

@section('content')
  <div class="page-header col-12">
            <div class="row">
                <h2>Manage Home page</h2>
                <p>From this section, you can manage Home page</p>
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
            <div class="row">
                <form method="POST" class="col-12 content">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group p-title">
                                <h4 class="title-contact">Page title</h4>
                                <input name="title" type="text" value="{{$homePageContent->title}}" placeholder="Lorem ipsum" class="form-control page-title">
                            </div>
                            <div class="form-group p-content">
                                <h4 class="title-contact">About Xeno Publisher Content</h4>
                                <textarea class="summernote" name="editordata">{{$homePageContent->content}}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="action-buttons">
                    <button type="reset" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-save">Save</button>
                </div>
            </div>
        </div>
        <div class="page-header col-12 popular-journals">
            <div class="row">
                <h2>Xeno Journals</h2>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                <form method="POST" action="/admin/update-journal-preview" class="col-12" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @for($i = 0; $i < 5; $i++)
                    <div class="row content">
                        <div class="col-6">
                            <div class="form-group p-title">
                                <h4 class="title-contact">Image</h4>
                                <hr>
                            </div>
                            <div class="form-group p-content">
                                 <div class="image-download can_remove">
                                    <input name="journal_image{{$i + 1}}" type="file" class="dropify" data-height="300" data-default-file="@if(count($journalsPreview) > 0){{asset('uploads/images/'.$journalsPreview[$i]->image)}}@endif" accept="image/*">
                                 </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group p-title">
                                <h4 class="title-contact">Journal Name</h4>
                                <hr>
                            </div>
                            <div class="form-group p-content">
                                 <textarea name="journal_details{{$i + 1}}" placeholder="Max 4 words" class="journal-name"> @if(count($journalsPreview) > 0) {{$journalsPreview[$i]->details}} @endif </textarea>
                            </div>
                        </div>
                    </div>
                    @endfor
                    <div class="action-buttons">
                        <button type="reset" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
@endsection