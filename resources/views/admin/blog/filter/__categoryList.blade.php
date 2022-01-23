@if (count($categories))
    @if ($categories->hasPages())
        <div class="app-action">
            <div class="action-left" id="link">
                {{ $categories->links('vendor.pagination.vuexy') }}
            </div>
        </div>
    @endif
    @if ($categories[count($categories) - 1]['parent_id'] && $categories[count($categories) - 1]['parent_id'] == $categories[0]['parent_id'])
        <li class="filter-item">
            <div class="btn btn-primary round back" data-type="category" data-key="{{ $categories[0]['parent_id'] }}">
                <i class="uil uil-arrow-left"></i> Back
            </div>
        </li>
    @endif

    @foreach ($categories as $category)
        <li class="filter-item">
            <div class="filter-title-wrapper">
                <div class="filter-title-area">
                    {{-- <i data-feather="more-vertical" class="drag-icon"></i> --}}

                    <i class="uil uil-ellipsis-v drag-icon"></i>

                    <div class="title-wrapper">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input select-single"
                                id="customCheck{{ $category->slug }}" data-title="{{ $category->title }}"
                                data-slug="{{ $category->slug }}" data-key="{{ $category->id }}"
                                data-type="category" data-parent="{{ $category->parent_id }}"
                                data-parenttext="{{ $category->parent_id ? \App\Models\Category::option($category->parent_id)->title : '' }}"
                                data-description="{{ $category->description }}" />
                            <label class="custom-control-label" for="customCheck{{ $category->slug }}"></label>
                        </div>
                        <span class="filter-title">{{ $category->title }}</span>
                    </div>
                </div>
                <div class="filter-item-action">
                    {{-- <div class="badge-wrapper mr-1">
                        <div class="badge badge-pill badge-light-primary">Team</div>
                    </div> --}}
                    <small class="text-nowrap text-muted mr-1">
                        @if (count($category->node))
                            <div data-parent="{{ $category->id }}" class="btn round nodes"
                                data-route="category.index" data-type="category">
                                {{ count($category->node) }}
                                Node<i class="uil uil-angle-right-b"></i>
                            </div>
                        @endif
                        {{-- {{ $category->updated_at->diffForHumans() }} --}}
                    </small>
                </div>
            </div>
        </li>
    @endforeach
@else
    <div class="no-results show">
        <h5>No Items Found</h5>
    </div>
@endif
