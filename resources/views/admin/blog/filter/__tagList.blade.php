@if (count($tags))
    @if ($tags->hasPages())
        <div class="app-action">
            <div class="action-left" id="link">
                {{ $tags->links('vendor.pagination.vuexy') }}
            </div>
        </div>
    @endif
    @foreach ($tags as $tag)
        <li class="filter-item">
            <div class="filter-title-wrapper">
                <div class="filter-title-area">
                    <div class="title-wrapper">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input select-single"
                                data-title="{{ $tag->title }}" data-slug="{{ $tag->slug }}" data-type="tags"
                                id="customCheck{{ $tag->slug }}" data-key="{{ encrypt($tag->id) }}" />
                            <label class="custom-control-label" for="customCheck{{ $tag->slug }}"></label>
                        </div>
                        <span class="filter-title">{{ $tag->title }}
                        </span>
                    </div>
                </div>
                <div class="filter-item-action">
                    <small class="text-nowrap text-muted mr-1">{{ $tag->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </li>
    @endforeach
@else
    <div class="no-results show">
        <h5>No Items Found</h5>
    </div>
@endif
