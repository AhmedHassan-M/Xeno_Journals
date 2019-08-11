@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>Manage Downloads</h2>
                <p>From this section, you can manage Manage Downloads page</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                @if(session()->has('failure'))
                    <div class="alert alert-danger">
                        {{ session()->get('failure') }}
                    </div>
                @endif
                @if(session()->has('success1'))
                    <div class="alert alert-success">
                        {{ session()->get('success1') }}
                    </div>
                @endif
                <form class="col-12" action="/admin/manage_downloads" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="req" value="content">
                    <div class="row">
                        <div class="col-12 content-wrapper">
                            <div class="col-lg-9 col-md-12">
                                <div class="form-group">
                                    <h4 class="title" >Page Content</h4>
                                    <textarea class="summernote" name="content">{{$content->content}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-container col-12">
                            <a href="/admin/manage_downloads" class="btn btn-cancel">Cancel</a>
                            <button  class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
                @if(session()->has('failure2'))
                    <div class="alert alert-danger">
                        {{ session()->get('failure2') }}
                    </div>
                @endif
                @if(session()->has('success2'))
                    <div class="alert alert-success">
                        {{ session()->get('success2') }}
                    </div>
                @endif
                @foreach ($downloads as $download)
                <form class="col-12" action="/admin/downloads" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="download-item col-12">
                            <div class="actions">
                                <input type="hidden" name="id" value="{{$download->id}}">
                                <a class="action-btn delete" href="/admin/downloads-delete/{{$download->id}}"><img src="{{asset('admin/images/trash-alt-solid.svg')}}"></a>
                                <button type="button" class="action-btn edit"><img src="{{asset('admin/images/edit-regular.svg')}}"></button>
                                <button type="button" class="action-btn save d-none"><img src="{{asset('admin/images/save-solid.svg')}}"></button>
                            </div>
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="hide-text" type="text" placeholder="Title" value="{{$download->title}}" name="title" required disabled>
                                            </td>
                                            <td>
                                                <textarea class="hide-text" name="description" required disabled>{{$download->description}}</textarea>
                                            </td>
                                            <td>
                                                <p class="file-name">{{$download->file}}</p>
                                                <input type="file" accept="application/pdf,.docx" name="file" class="hide-text" value=""  required disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="alert alert-success d-none" role="alert">
                                Saved!
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
                <form class="col-12" action="/admin/manage_downloads" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="req" value="new file">
                    <div class="row">
                        <div class="download-item add col-12">
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="Title" name="title" required>
                                            </td>
                                            <td>
                                                <textarea placeholder="Description" name="description"></textarea>
                                            </td>
                                            <td>
                                                <input type="file" name="file" accept="application/pdf,.docx">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="alert alert-success d-none" role="alert">
                                Saved!
                            </div>
                        </div>
                        <div class="buttons-container col-12">
                            <a href="/admin/manage_downloads" class="btn btn-cancel">Cancel</a>
                            <button  class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('scripts')

<script>
    
function downloadItemSave(button) {
    const url = '/admin/edit_download';
    const _token = $('input[name="_token"]').val();
    const file = button.parents('.download-item').find('input[name="file"]').prop('files')[0];
    const title = button.parents('.download-item').find('input[name="title"]').eq(0).val();
    const id = button.parents('.download-item').find('input[name="id"]').eq(0).val();
    const description = button.parents('.download-item').find('textarea[name="description"]').eq(0).val();
    var form_data = new FormData();
    form_data.append('id', id);
    if (Boolean(file)) {
        form_data.append('file', file);
    }
    form_data.append('title', title);
    form_data.append('description', description);
    console.log(file);
    $.ajax({
        headers: { 
            "X-CSRF-TOKEN" : _token
        },
        type: 'POST',
        url: url,
        data: form_data,
        contentType: false,
        cache: false, 
        processData: false,
        success: function (data) {
            console.log(data);
            if (Boolean(file)) {
                button.parents('.download-item').find('.file-name').text(file.name);
            }
            button.parents('.download-item').find('.file-name').removeClass('d-none');
            button.parents('.download-item').find('textarea, input').each(function () {
                $(this).addClass('hide-text').attr('disabled', 'disabled');
            });
            button.addClass('d-none');
            button.parents('.actions').children('.edit').removeClass('d-none');
            button.parents('.download-item').find('.alert').removeClass('d-none');
            setTimeout(function () {
                button.parents('.download-item').find('.alert').addClass('d-none');
            }, 2000);
        },
        error: function (data) {
            console.log('error');
        }
    });
}
    
</script>

@endsection