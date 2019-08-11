<!-- START JOURNAL MODAL -->

<div class="modal fade" id="viewJournalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle">Journal Name</h5>
                <button class="delete-modal-btn" data-toggle="modal" data-target="#confirmDeleteJournalModal">
                    <img src="{{asset('admin/images/trash-alt-gray.svg')}}" alt="delete">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="journal_id" value="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Journal Name</h5>
                                    <p class="text can-edit" id="name_text">Lorem Ipsum</p>
                                    <input id="journal_name" name="journal_name" type="text" class="d-none edit-input" value="Lorem Ipsum" required>
                                    <button class="edit-modal-data-btn">
                                        <span>Edit</span>
                                    </button>
                                    <button class="save-modal-data-btn d-none">
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Number of Volumes</h5>
                                    <p class="text can-edit" id="number_volumes">Lorem Ipsum</p>
                                    <input type="text" id="number_volumes-edit" class="d-none edit-input numbers_only_input" value="3" required>
                                    <button class="edit-modal-data-btn">
                                        <span>Edit</span>
                                    </button>
                                    <button class="save-modal-data-btn d-none">
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Number of Articles</h5>
                                    <p class="text" id="number_text">Lorem Ipsum</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Journal Description</h5>
                                    <p class="text can-edit" id="journal_description">Lorem Ipsum</p>
                                    <textarea name="" id="journal_description-edit" class="d-none edit-input styled_textarea" value="Lorem Ipsum" required></textarea>
                                    <button class="edit-modal-data-btn">
                                        <span>Edit</span>
                                    </button>
                                    <button class="save-modal-data-btn d-none">
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="journal_details">
                            <div class="col-12 single-volume">
                                <div class="row single-volume-container">
                                    <div class="col-12 single-volume-title">
                                        <div class="row">
                                            <div class="volume-separator">
                                                <p class="volume_name">Volume One</p>
                                                <span class="line"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="articles col-12">
                                        <div class="row">
                                            <div class="col-12 articles-container">
                                                <div class="row category">
                                                    <span class="line"></span>
                                                    <p class="category-title">Chemistry</p>
                                                    <span class="line"></span>
                                                </div>
                                                <div class="row category-articles">
                                                    <div class="col-12 article">
                                                        <div class="article-content">
                                                            <p class="article-category">
                                                                <span>XENO BIOMEDICAL JOURNAL</span>
                                                            </p>
                                                            <p class="article-date">
                                                                <span>June 23, 2019</span>
                                                            </p>
                                                            <h6 class="article-title">
                                                                Open Quantum Computation and Simulation
                                                            </h6>
                                                            <p class="article-author">
                                                                <span class="author-name">by Luodong Huang</span>
                                                                <span class="line"></span>
                                                            </p>
                                                            <p class="article-excerpt">
                                                                In this collection PLOS ONE hopes to encourage greater transparency and reproducibility in research through open availability of source code. The collection will comprise original research papers related to all aspects of quantum computation
                                                            </p>
                                                            <p class="article-link">
                                                                <a href="#" target="_blank">
                                                                    <span>See Abstract </span>
                                                                    <i class="fas fa-long-arrow-alt-right"></i>
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END JOURNAL MODAL -->



<!-- START CONFIRMATION MODAL -->

<div class="modal fade" id="confirmDeleteJournalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="confirm_delete_journal_form" class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="confirm_delete_journal_id" name="journal_id" value="">
                            <h5>Are you sure you want to delete this Journal !</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_journal_btn">Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- END CONFIRMATION MODAL -->