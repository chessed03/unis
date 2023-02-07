<?php use App\Models\System\Module; ?>

<aside class="main-sidebar sidebar-light-dark elevation-1">

    <a href="#" class="brand-link navbar-dark text-sm">
        <img src="{{ asset("template/admin/img/images/AdminLTELogo.png" )}}" alt="Name" class="brand-image img-circle">
        <span class="brand-text font-weight-light text-white">

      AdminLTE 3  </span>
    </a>

    <div class="sidebar">
        <br>
        <div class="user-panel">
            <div style="justify-content: center;">
                <div class="text-center font-weight-normal">

                    <img src="#" class="rounded-circle" style="width: 60px; height: 60px;">

                    <br>

                    <h6><span style="color: #1c3550;">{{ auth()->user()->name }}</span></h6>

                    <span style="color: #7d7f83;">{{ auth()->user()->email }}</span>
                    <br>
                    <br>
                </div>
            </div>
        </div>

        <div class="user-panel">
            <div style="justify-content: center;">
                <div class="text-center">
                    <a href="#" class="d-block">NAVEGATION</a>
                </div>
            </div>
        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">

                <?php

                    $user_id            = auth()->user()->id;
                    $route_current      = Route::getCurrentRoute()->getName();
                    $parse_route_actual = explode('_', $route_current);
                    $route_current      = $parse_route_actual[0];
                    $modules_model      = new Module();
                    $modules            = $modules_model->getModulesForMenu($user_id);

                    foreach ($modules['modules'] as $key => $val) {

                        $modules['modules'][$key]['active'] = "nav-link";
                        $modules['modules'][$key]['style'] = "display: none;";
                        $modules['modules'][$key]['menu_open'] = "nav-item has-treeview";

                        foreach ($modules['submodules'][$val->id] as $k => $v) {

                            if ($v['route'] == $route_current) {

                                $modules['modules'][$key]['active'] = ( $v['route'] == '403' ) ? "nav-link" : "nav-link active";
                                $modules['modules'][$key]['style'] = ( $v['route'] == '403' ) ? "display: none;" : "display: block;";
                                $modules['modules'][$key]['menu_open'] = ( $v['route'] == '403' ) ? "nav-item has-treeview" : "nav-item has-treeview menu-open";

                            }

                        }

                    }
                ?>

                @foreach ($modules['modules'] as $val)

                    <li class="{{ $val['menu_open'] }}">

                        <a href="#" class="{{ $val['active'] }}">

                            <i class="nav-icon {{ $val['icon'] }}"></i>
                            <p> {{ $val['name'] }} <i class="right fa fa-angle-left"></i></p>

                        </a>

                        <ul class="nav nav-treeview" style="{{ $val['style'] }}">


                            @foreach($modules['submodules'][$val->id] as $v)

                                <li class="nav-item">

                                    <a href="{{ ( $v['route'] == '403' ) ? '#' : route($v['route']) }}" onclick="{{ ( $v['route'] == "403" ) ? 'warningModal()' : '' }}"
                                       class="{{ ( $v['route'] == '403' ) ? 'nav-link' : ( ( $v['route'] == $route_current ) ? 'nav-link active' : 'nav-link' ) }}">

                                        <i class="{{ ($v['route'] == $route_current) ? 'bx-fw bx bxs-toggle-right' : $v['icon'] . ' text-secondary' }} nav-icon"></i>
                                        <p class="{{ ( $v['route'] == '403' ) ? 'text-secondary' : ''  }}">{{ $v['name'] }}</p>

                                    </a>

                                </li>

                            @endforeach

                        </ul>

                    </li>

                @endforeach

            </ul>

        </nav>

    </div>

</aside>
