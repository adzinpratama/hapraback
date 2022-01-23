@if (count($users))
    <ul class="users-media-list">
        @foreach ($users as $user)
            <li class="media detail-read">
                <div class="media-left pr-50">
                    <div class="avatar">
                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-20.jpg') }}"
                            alt="avatar img holder" />
                    </div>
                    <div class="user-action">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                id="customCheck{{ $user->nickname }}" />
                            <label class="custom-control-label" for="customCheck{{ $user->nickname }}"></label>
                        </div>
                        <span class="users-favorite"><i data-feather="star"></i></span>
                    </div>
                </div>
                <div class="media-body">
                    <div class="detail-details">
                        <div class="detail-items">
                            <h5 class="mb-25">{{ $user->name }}</h5>
                            <span class="text-truncate">{{ $user->role->name }}
                            </span>
                        </div>
                        <div class="detail-meta-item">
                            @if ($user->role->name == 'superadmin')
                                <span class="mr-50 bullet bullet-primary bullet-sm"></span>
                            @else
                                <span class="mr-50 bullet bullet-success bullet-sm"></span>
                            @endif
                            <span class="detail-date">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="detail-message">
                        <p class="text-truncate mb-0">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="no-results">
        <h5>No Items Found</h5>
    </div>
@endif
