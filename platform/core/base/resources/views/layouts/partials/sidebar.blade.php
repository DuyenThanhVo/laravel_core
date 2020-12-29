<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            @foreach ($menus = dashboard_menu()->getAll() as $menu)
                @php
                    $has_submenu = false;
                    if(isset($menu['children']) && count($menu['children'])) $has_submenu = true;
                @endphp
                <li class="menu-item
                    @if ($menu['active'])
                        menu-item-active
                        @if($has_submenu)
                            menu-item-open menu-item-here
                        @endif
                    @endif
                    @if ($has_submenu) menu-item-submenu @endif
                    "
                    aria-haspopup="true">
                    <a href="{{ $has_submenu ? 'javascript:;' : $menu['url'] }}" class="menu-link
                    @if($has_submenu) menu-toggle @endif
                    ">
                        <span class="menu-icon {{ $menu['icon'] }}"></span>
                        <span class="menu-text">{{ trans($menu['name']) }}</span>
                        @if($has_submenu) <i class="menu-arrow"></i> @endif
                    </a>
                    @if($has_submenu)
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">{{ trans($menu['name']) }}</span>
                                    </span>
                                </li>
                                @foreach ($menu['children'] as $item)
                                    <li class="menu-item
                                    @if ($item['active']) menu-item-active @endif
                                        menu-item-submenu" aria-haspopup="true"
                                        data-menu-toggle="hover">
                                        <a href="{{ $item['url'] }}" class="menu-link menu-toggle">
                                            <i class="menu-bullet menu-bullet-line">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">{{ trans($item['name']) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
