<x-layouts.admin-main>
    <!-- BEGIN: Content-->
    <div class="app-content content users-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content users-app-sidebar">
                        <div class="users-app-menu">
                            <div class="form-group-compose text-center compose-btn">
                                <button type="button" class="compose-users btn btn-primary btn-block"
                                    data-backdrop="false" data-toggle="modal" data-target="#compose-mail">
                                    Compose
                                </button>
                            </div>
                            <div class="sidebar-menu-list">
                                <div class="list-group list-group-messages">
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action active">
                                        <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">All</span>
                                        <span class="badge badge-light-primary badge-pill float-right">3</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <i data-feather="send" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Active</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <i data-feather="edit-2" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">InActive</span>
                                        <span class="badge badge-light-warning badge-pill float-right">2</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <i data-feather="star" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Block</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <i data-feather="trash" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Trash</span>
                                    </a>
                                </div>
                                <!-- <hr /> -->
                                <h6 class="section-label mt-3 mb-1 px-2">Labels</h6>
                                <div class="list-group list-group-labels">
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action"><span
                                            class="bullet bullet-sm bullet-primary mr-1"></span>SuperAdmin</a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action"><span
                                            class="bullet bullet-sm bullet-success mr-1"></span>Author</a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- users list Area -->
                        <div class="users-app-list">
                            <!-- users search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="search"
                                                    class="text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="users-search"
                                            placeholder="Search users" aria-label="Search..."
                                            aria-describedby="users-search" />
                                    </div>
                                </div>
                            </div>
                            <!-- users search ends -->

                            <!-- users actions starts -->
                            <div class="app-action">
                                <div class="action-left">
                                    <div class="custom-control custom-checkbox selectAll">
                                        <input type="checkbox" class="custom-control-input" id="selectAllCheck" />
                                        <label class="custom-control-label font-weight-bolder pl-25"
                                            for="selectAllCheck">Select All</label>
                                    </div>
                                </div>
                                <div class="action-right">
                                    {{-- <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" id="folder"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="folder" class="font-medium-2"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="folder">
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:void(0);">
                                                        <i data-feather="edit-2" class="font-small-4 mr-50"></i>
                                                        <span>Draft</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:void(0);">
                                                        <i data-feather="info" class="font-small-4 mr-50"></i>
                                                        <span>Spam</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:void(0);">
                                                        <i data-feather="trash" class="font-small-4 mr-50"></i>
                                                        <span>Trash</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" id="tag"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="tag" class="font-medium-2"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-success bullet-sm"></span>Personal</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-primary bullet-sm"></span>Company</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-warning bullet-sm"></span>Important</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-danger bullet-sm"></span>Private</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item mail-unread">
                                            <span class="action-icon"><i data-feather="mail"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                        <li class="list-inline-item mail-delete">
                                            <span class="action-icon"><i data-feather="trash-2"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                            <!-- users actions ends -->

                            <!-- users list starts -->
                            <div class="users-user-list" id="list-wraper">

                            </div>
                            <!-- users list ends -->
                        </div>
                        <!--/ users list Area -->
                        <!-- Detailed users View -->
                        <div class="users-app-details">
                            <!-- Detailed users Header starts -->
                            <div class="users-detail-header">
                                <div class="users-header-left d-flex align-items-center">
                                    <span class="go-back mr-1"><i data-feather="chevron-left"
                                            class="font-medium-4"></i></span>
                                    <h4 class="users-subject mb-0">Focused open system 😃</h4>
                                </div>
                                <div class="users-header-right ml-2 pl-1">
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <span class="action-icon favorite"><i data-feather="star"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="dropdown no-arrow">
                                                <a href="javascript:void(0);" class="dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="folder" class="font-medium-2"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="folder">
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:void(0);">
                                                        <i data-feather="edit-2" class="font-medium-3 mr-50"></i>
                                                        <span>Draft</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:void(0);">
                                                        <i data-feather="info" class="font-medium-3 mr-50"></i>
                                                        <span>Spam</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:void(0);">
                                                        <i data-feather="trash" class="font-medium-3 mr-50"></i>
                                                        <span>Trash</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="dropdown no-arrow">
                                                <a href="javascript:void(0);" class="dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="tag" class="font-medium-2"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="tag">
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-success bullet-sm"></span>Personal</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-primary bullet-sm"></span>Company</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-warning bullet-sm"></span>Important</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"><span
                                                            class="mr-50 bullet bullet-danger bullet-sm"></span>Private</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="action-icon"><i data-feather="mail"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="action-icon"><i data-feather="trash"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                        <li class="list-inline-item users-prev">
                                            <span class="action-icon"><i data-feather="chevron-left"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                        <li class="list-inline-item users-next">
                                            <span class="action-icon"><i data-feather="chevron-right"
                                                    class="font-medium-2"></i></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detailed users Header ends -->

                            <!-- Detailed users Content starts -->
                            <div class="users-scroll-area">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="users-label">
                                            <span
                                                class="mail-label badge badge-pill badge-light-primary">Company</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- User Card starts-->
                                    <div class="col-12">
                                        <div class="card profile-header mb-2">
                                            <!-- profile cover photo -->
                                            <img class="card-img-top"
                                                src="../../../app-assets/images/profile/user-uploads/timeline.jpg"
                                                alt="User Profile Image" />
                                            <!--/ profile cover photo -->

                                            <div class="position-relative">
                                                <!-- profile picture -->
                                                <div class="profile-img-container d-flex align-items-center">
                                                    <div class="profile-img">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg"
                                                            class="rounded img-fluid" alt="Card image" />
                                                    </div>
                                                    <!-- profile title -->
                                                    <div class="profile-title ml-3">
                                                        <h2 class="text-white">Kitty Allanson</h2>
                                                        <p class="text-white">UI/UX Designer</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- tabs pill -->
                                            <div class="profile-header-nav">
                                                <!-- navbar -->
                                                <nav
                                                    class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">

                                                </nav>
                                                <!--/ navbar -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /User Card Ends-->

                                    <!-- Plan Card starts-->
                                    <div class="col-md-12">
                                        <div class="card user-card">
                                            <div class="card-body">
                                                <div class="user-info-wrapper">
                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-feather="user" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Username</span>
                                                        </div>
                                                        <p class="card-text mb-0">eleanor.aguilar</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="check" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                                        </div>
                                                        <p class="card-text mb-0">Active</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="star" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Role</span>
                                                        </div>
                                                        <p class="card-text mb-0">Admin</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="flag" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Country</span>
                                                        </div>
                                                        <p class="card-text mb-0">England</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-feather="phone" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Contact</span>
                                                        </div>
                                                        <p class="card-text mb-0">(123) 456-7890</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Plan CardEnds -->
                                </div>
                            </div>
                            <!-- Detailed users Content ends -->
                        </div>
                        <!--/ Detailed users View -->



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--- Menu Popup --->
    <div class="menu-wrap">
        <div class="menu-overlay"></div>
        <div class="menu-pop">
            <div class="menu" id="menu-add">
                <div class="toggle btn btn-icon btn-primary" id="add">
                    <i data-feather="plus"></i>
                </div>
                <li style="--i:0;--r:1;">
                    <a href="#" class="btn-menu" data-action="add-tag" data-toggle="tooltip" data-trigger="hover"
                        data-original-title="Fast User adding">
                        <i class="uil uil-bolt"></i>
                    </a>
                </li>
                <li style="--i:1;--r:2;">
                    <a href="#" class="btn-menu" data-action="add-category" data-toggle="tooltip"
                        data-trigger="hover" data-original-title="User Adding">
                        <i class="uil uil-chat-bubble-user"></i>
                    </a>
                </li>
            </div>

            <div class="menu menu-select d-none" id="menu-delete">
                <div class="toggle btn btn-icon btn-primary" id="remove">
                    <i data-feather="trash-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->
    <x-slot name="title">User</x-slot>
    <x-slot name="css_vendor">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/editors/quill/katex.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/editors/quill/quill.snow.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </x-slot>
    <x-slot name="css_page">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/css/plugins/forms/form-quill-editor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/user.css') }}">
    </x-slot>
    <x-slot name="js_vendor">
        <script src="{{ asset('app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    </x-slot>
    <x-slot name="js_page">
        <script src="{{ asset('assets/js/pages/user.js') }}"></script>
    </x-slot>
</x-layouts.admin-main>
