<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                    <span class="brand-logo">
                        <?xml version="1.0" standalone="no"?>
                        <!DOCTYPE svg
                            PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="38" height="38"
                            viewBox="0 0 137.000000 135.000000" preserveAspectRatio="xMidYMid meet">

                            <g transform="translate(0.000000,135.000000) scale(0.100000,-0.100000)" fill="#8E73F3"
                                stroke="none">
                                <path d="M590 1263 c-234 -39 -450 -242 -505 -474 -96 -411 229 -800 649 -777
                                277 16 511 206 581 473 8 33 15 101 15 155 0 113 -17 187 -66 287 -78 158
                                -241 287 -416 328 -58 14 -199 18 -258 8z m412 -359 c3 -3 -15 -51 -42 -107
                                -70 -150 -69 -147 -21 -147 42 0 62 -14 35 -24 -9 -3 -33 -6 -54 -6 l-39 0
                                -21 -66 c-11 -36 -20 -88 -20 -114 0 -54 -16 -73 -37 -45 -15 21 -17 120 -4
                                178 l9 39 -36 -7 c-21 -3 -44 -8 -52 -11 -10 -2 -27 -40 -44 -91 -32 -99 -75
                                -153 -120 -153 -74 0 -136 60 -136 132 0 66 71 126 178 149 l49 10 13 57 c6
                                31 20 76 30 100 11 23 15 42 11 42 -4 0 -32 -7 -62 -16 -60 -18 -119 -57 -119
                                -80 0 -22 -18 -17 -36 10 -25 39 -15 68 31 91 33 16 60 20 152 20 64 0 116 -4
                                122 -10 8 -8 0 -38 -24 -100 -19 -48 -35 -92 -35 -97 0 -4 20 -8 44 -8 l44 0
                                18 53 c21 64 60 154 80 185 10 15 24 22 48 22 18 0 35 -3 38 -6z" />
                                <path d="M578 545 c-54 -29 -78 -58 -78 -98 0 -67 56 -94 84 -39 11 21 48 163
                                43 162 -1 -1 -23 -12 -49 -25z" />
                            </g>
                        </svg>
                    </span>
                    <h2 class="brand-text">Hapra</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @foreach ($menus as $title => $bars)
                @if ($title)
                    <li class=" navigation-header"><span>{{ $title }}</span>
                    </li>
                @endif
                @foreach ($bars as $bar)
                    <li class="nav-item {{ set_active($bar['active']) }}"><a class="d-flex align-items-center"
                            href="{{ $bar['link'] ? $bar['link'] : '' }}"><i
                                data-feather="{{ $bar['icon'] }}"></i><span class="menu-title text-truncate"
                                data-i18n="{{ $bar['label'] }}">{{ $bar['label'] }}</span></a>
                        @if ($bar['child'])
                            <ul class="menu-content">
                                @foreach ($bar['child'] as $child)
                                    <li class="{{ set_active($bar['active']) }}"><a class="d-flex align-items-center"
                                            href="{{ $child['link'] ? $child['link'] : '' }}"><i
                                                data-feather="{{ $child['icon'] }}"></i><span
                                                class="menu-item text-truncate"
                                                data-i18n="{{ $child['label'] }}">{{ $child['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
