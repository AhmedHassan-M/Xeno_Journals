@extends('layouts.master_admin')

@section('content')
        <div class="page-header col-12">
            <div class="row">
                <h2>All Journals</h2>
                <p>All Information you want to Know about all Journals</p>
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
                                    <th>Journal Name</th>
                                    <th># of Volumes</th>
                                    <th># of Articles</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($journals as $i => $journal)
                                <tr> 
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select-checkbox" id="check{{$journal->id}}">
                                            <input type="hidden" name="id" value="{{$journal->id}}">
                                            <label class="custom-control-label" for="check{{$journal->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$journal->title}}</p>
                                    </td>
                                    <td>
                                        <p>{{$journal->volumes}}</p>
                                    </td>
                                    <td>
                                        <p>{{count($journal->article)}}</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="#" onclick="showJournal({{$journal}})" data-toggle="modal" data-target="#viewJournalModal" class="show-more-btn">Show More</a>
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
        @include('layouts.inc.admin_viewJournal_modal')
@endsection
<script>
    function submitHandler() {
        const url ='/admin/journal_delete' ;
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
                window.location.href="/admin/all_journals";
           },
            error: function (data) {
                console.log('error');
            }
        });
    }

    function inWords (num) {
        var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
        var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
        return str;
    }

    function showJournal(item) {
        console.log(item);
        const modal = $('#viewJournalModal');
        let i;
        let articles;
        $(modal).find('#exampleModalLongTitle').text(item.title);
        $(modal).find('#name_text').text(item.title);
        $(modal).find('#journal_name').val(item.title);
        $(modal).find('#number_volumes').text(item.volumes);
        $(modal).find('#number_volumes-edit').val(item.volumes);
        $(modal).find('#number_text').text(item.article.length);
        $(modal).find('#journal_description').text(item.description);
        $(modal).find('#journal_description-edit').text(item.description);
        $(modal).find('input[name="journal_id"]').val(item.id);
        $('#confirmDeleteJournalModal').find('#confirm_delete_journal_id').val(item.id);

        // clone the first volume 
        const singleVolume = $(modal).find('.single-volume').eq(0).clone();
        // categories 
        const categoriesArray = ['chemistry', 'energy', 'dentistry', 'biomedicine', 'education'];
        // remove class d-none from the cloned volume
        singleVolume.removeClass('d-none');
        // store categories from cloned volume to clear the cloned volume after cloning one
        const clonedCategories = singleVolume.find('.category');
        // store category articles from cloned volume to clear the cloned volume after cloning one
        const clonedCategoryArticles = singleVolume.find('.category-articles');
        // store articles from the first category articles container in the cloned volume to clear the cloned volume after cloning one
        const clonedArticles = singleVolume.find('.category-articles').eq(0).find('.article');
        // clone a category from the cloned volume
        const singleClonedCategory = singleVolume.find('.category').eq(0).clone();
        // remove all categories from the cloned volume
        for (let i = 0; i < clonedCategories.length; i++) {
            singleVolume.find('.category').eq(i).remove();
        }
        // clone a single article from the cloned volume
        const singleClonedArticle = singleVolume.find('.article').eq(0).clone();
        // remove all articles from the first category articles container to prepare it to be cloned
        for (let i = 0; i < clonedArticles.length; i++) {
            singleVolume.find('.category-articles').eq(0).find('.article').eq(i).remove();
        }
        // now clone the first category articles container from the cloned volume
        const singleClonedArticleContainer = singleVolume.find('.category-articles').eq(0).clone();
        // remove all category articles containers from the cloned volume
        for (let i = 0; i < clonedCategoryArticles.length; i++) {
            singleVolume.find('.category-articles').eq(i).remove();
        }
        // remove all volumes except for the first one
        for (let i = $(modal).find('.single-volume').length; i > 0; i--) {
            $(modal).find('.single-volume').eq(i).remove();
        }
        // hide the last volume
        $(modal).find('.single-volume').eq(0).addClass('d-none');

        // Loop for volumes
        for (i = 1 ; i <= item.volumes; i++) {
            let thisVolume = singleVolume.clone();
            thisVolume.find('.volume_name').text(`Volume ${inWords(i)}`);
            const thisVolumeArticles = item.article.filter((article) => article.volume == i);
            let thisVolumeCategories = [];
            for (let articleItem of thisVolumeArticles) {
                let cat = articleItem.type;
                if (!thisVolumeCategories.includes(cat)) {
                    thisVolumeCategories.push(cat);
                }
            }
            for (let i = 0; i < thisVolumeCategories.length; i++) {
                let thisCategory = singleClonedCategory.clone();
                let thisArticleContainer = singleClonedArticleContainer.clone();
                thisCategory.find('.category-title').text(thisVolumeCategories[i]);
                const thisCategoryArticles = thisVolumeArticles.filter((article) => article.type == thisVolumeCategories[i]);
                thisVolume.find('.articles-container').append(thisCategory);
                
                for (let singleArticle of thisCategoryArticles) {
                    let appendArticle = singleClonedArticle.clone();
                    appendArticle.find('.article-category').children('span').text(item.title);
                    appendArticle.find('.article-date').children('span').text(singleArticle.published_at);
                    appendArticle.find('.article-title').text(singleArticle.title);
                    appendArticle.find('.article-author').children('.author-name').text(singleArticle.user.name);
                    appendArticle.find('.article-excerpt').html(singleArticle.keywords);
                    appendArticle.find('.article-link').children('a').attr('href', `/article/${singleArticle.id}`);
                    thisArticleContainer.append(appendArticle);                    
                }
                thisVolume.find('.articles-container').append(thisArticleContainer);
            }
            $(modal).find('#journal_details').append(thisVolume);
        }
    }

</script>