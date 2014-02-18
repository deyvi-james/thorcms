<!-- Static navbar -->
<div class="admin-navbar navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{admin_url()}}">ThorCMS</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{admin_url()}}"><i class="fa fa-dashboard"></i></a></li>
                <li><a href="#">Pages</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Users</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuration <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Menus</a></li>
                        <li><a href="#">Strings</a></li>
                        <li>{{link_to_route('admin.languages.index', 'Languages')}}</li>
                        <li class="divider"></li>
                        <li><a href="#">Preferences</a></li>
                    </ul>
                </li>
                <li><a href="{{URL::route('account.logout')}}">Log out</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>