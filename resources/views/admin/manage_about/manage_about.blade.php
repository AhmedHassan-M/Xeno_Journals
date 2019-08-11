@extends('layouts.master_admin')

@section('content')
<div class="page-header col-12">
    <div class="row">
        <h2>Manage About Xeno</h2>
        <p>From this section, you can manage about xeno page</p>
    </div>
</div>
<div class="page-content col-12 manage-about-page">     
    <form method="POST" class="row page-content-section">
        {{ csrf_field() }}
        <div class="col-12">
            <div class="row">
                <input type="hidden" id="active-pane-id" value="">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" 
                            aria-orientation="vertical">
                                @foreach ($abouts as $i => $about)
                                <button class="nav-link" id="id-{{$i}}-tab"
                                data-toggle="pill" href="#id-{{$i}}"
                                role="tab" aria-controls="id-{{$i}}" aria-selected="true">
                                    <span>
                                        <!-- <input type="text" name="page-{{$i}}" value="About Xeno {{$i}}"> -->
                                        {{$about->title}}
                                    </span>
                                </button>
                                @endforeach
                                <button class="nav-link" type="button" data-toggle="modal" data-target="#addAboutModal">
                                    <span>
                                        + Add New Page
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-content">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach ($abouts as $i => $about)
                                    <div class="tab-pane fade" id="id-{{$i}}" role="tabpanel" aria-labelledby="id-{{$i}}-tab">
                                        <input type="hidden" name="page_id" value="{{$about->id}}">
                                        <h5 class="title">
                                            <input type="text" name="title{{$about->id}}" value="{{$about->title}}">
                                        </h5>
                                        <div class="content">
                                            <p>
                                                <textarea name="content{{$about->id}}" class="summernote">
                                                    {{$about->paragraph}}
                                                </textarea>
                                            </p>
                                            <div class="button">
                                                <button type="button" class="btn delete-btn delete_page_btn">Delete this page</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="action-buttons">
                    <button type="reset" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-save">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@include('layouts.inc.admin_about_modal')
@endsection