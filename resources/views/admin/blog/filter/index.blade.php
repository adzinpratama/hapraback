<x-layouts.admin-main>
    <!-- BEGIN: Content-->
    <div class="app-content content filter-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content filter-sidebar">
                        <div class="filter-app-menu">
                            {{-- <div class="add-task">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                    data-target="#new-task-modal" >
                                    Add Task
                                </button>
                            </div> --}}
                            <div class="sidebar-menu-list mt-2">
                                <div id="current"></div>
                                <div class="list-group list-group-filters">
                                    <a href="javascript:void(0)" data-toggle="category"
                                        class="list-group-item list-group-item-action active">
                                        <i data-feather="layers" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Category</span>
                                    </a>
                                    <a href="javascript:void(0)" data-toggle="tags"
                                        class="list-group-item list-group-item-action">
                                        <i data-feather="tag" class="font-medium-3 mr-50"></i> <span
                                            class="align-middle">Tag</span>
                                    </a>
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
                        <div class="filter-app-list">
                            <!-- filter search starts -->
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
                                        <input type="text" class="form-control" id="filter-search"
                                            placeholder="Search task" aria-label="Search..."
                                            aria-describedby="filter-search" />
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle hide-arrow mr-1"
                                        id="filterActions" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="filterActions">
                                        <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
                                        <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
                                    </div>
                                </div>
                            </div>
                            <!-- filter search ends -->

                            <div class="app-action">
                                <div class="action-left">
                                    <div class="custom-control custom-checkbox selectAll">
                                        <input type="checkbox" class="custom-control-input" id="selectAllCheck" />
                                        <label class="custom-control-label font-weight-bolder pl-25"
                                            for="selectAllCheck">Select All</label>
                                    </div>
                                </div>
                                <div class="action-right">
                                    <ul class="list-inline m-0">
                                        {{-- <li class="list-inline-item tag-delete">
                                            <span class="action-icon"><i data-feather="trash-2"
                                                    class="font-medium-2"></i></span>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>

                            <!-- filter List starts -->
                            <div class="filter-task-list-wrapper list-group" id="filter-wrap">
                                <ul class="filter-task-list media-list" id="filter-list">

                                </ul>
                            </div>
                            <!-- filter List ends -->
                        </div>

                        <!-- Right Sidebar starts -->
                        <div class="modal modal-slide-in sidebar-filter-modal fade" id="myModal">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <form id="form-modal" class="filter-modal needs-validation" novalidate
                                        onsubmit="return false">
                                        @csrf
                                        <div class="modal-header align-items-center mb-1">
                                            <h5 class="modal-title"
                                                data-category="{{ trans('category.form.modal_title') }}"
                                                data-tag="Add Tag">Add Task</h5>
                                            <div
                                                class="filter-item-action d-flex align-items-center justify-content-between ml-auto">
                                                <button type="button" class="close font-large-1 font-weight-normal py-0"
                                                    data-dismiss="modal" aria-label="Close">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                            <div class="action-tags">
                                                <input type="hidden" name="id" id="key">
                                                <div class="form-group" id="group-title">
                                                    <label for="title"
                                                        class="form-label">{{ trans('category.form.title') }}</label>
                                                    <input type="text" id="title" name="title"
                                                        class="form-control area-input"
                                                        placeholder="{{ trans('category.form.title') }}" />
                                                    <div class="invalid-feedback" id="valid-title"></div>
                                                </div>
                                                <div class="form-group" id="group-slug">
                                                    <label for="slug"
                                                        class="form-label">{{ trans('category.form.slug') }}</label>
                                                    <input type="text" id="slug" name="slug"
                                                        class="form-control area-input"
                                                        placeholder="{{ trans('category.form.slug') }}" readonly />
                                                    <div class="invalid-feedback" id="valid-slug"></div>
                                                </div>
                                                <div class="form-group position-relative group-category"
                                                    id="group-parent">
                                                    <label for="parent"
                                                        class="form-label d-block">{{ trans('category.form.parent') }}</label>
                                                    <select class="select2 form-control" id="parent"
                                                        data-locale="{{ app()->getLocale() }}" name="parent"
                                                        data-placeholder="{{ trans('category.form.select_parent') }}">
                                                    </select>
                                                </div>
                                                <div class="form-group group-category" id="group-description">
                                                    <label
                                                        class="form-label">{{ trans('category.form.description') }}</label>
                                                    <div class="invalid-feedback" id="valid-description"></div>
                                                    <textarea name="description" id="description" rows="4"
                                                        class="form-control area-input"
                                                        placeholder="{{ trans('category.message.message_description') }}"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group my-1">
                                                <button type="submit" class="btn btn-primary add-item mr-1"
                                                    id="btn-trigger"
                                                    data-addName="{{ trans('category.button.add') }}"
                                                    data-updateName="{{ trans('category.button.update') }}"></button>
                                                <button type="button" class="btn btn-outline-secondary add-item"
                                                    data-dismiss="modal">
                                                    {{ trans('category.button.cancel') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Right Sidebar ends -->

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
                            <a href="#" class="btn-menu" data-action="add-tag" data-toggle="tooltip"
                                data-trigger="hover" data-original-title="Add Tag">
                                <i data-feather="tag"></i>
                            </a>
                        </li>
                        <li style="--i:1;--r:2;">
                            <a href="#" class="btn-menu" data-action="add-category" data-toggle="tooltip"
                                data-trigger="hover" data-original-title="Add Category">
                                <i data-feather="layers"></i>
                            </a>
                        </li>
                        {{-- <li style="--i:2;--r:3;">
                            <a href="#" class="btn-menu" data-toggle="tooltip" data-trigger="hover"
                                data-original-title="Set Filter">
                                <i data-feather="filter"></i>
                            </a>
                        </li> --}}
                    </div>

                    <div class="menu menu-select edit d-none" id="menu-edit">
                        <div class="toggle btn btn-icon btn-primary" id="edit">
                            <i data-feather="edit-2"></i>
                        </div>
                    </div>
                    <div class="menu menu-select d-none" id="menu-delete">
                        <div class="toggle btn btn-icon btn-primary" id="remove">
                            <i data-feather="trash-2"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END: Content-->
    <x-slot name="title">Filter</x-slot>
    <x-slot name="css_vendor">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/extensions/dragula.min.css') }}">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </x-slot>
    <x-slot name="css_page">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/filter.css') }}">
    </x-slot>
    <x-slot name="js_vendor">
        <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/extensions/dragula.min.js') }}"></script>
    </x-slot>
    <x-slot name="js_page">
        <script src="{{ asset('assets/js/pages/filter.js') }}"></script>

    </x-slot>
</x-layouts.admin-main>
