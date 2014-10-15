<!-- Header
================================================== -->
<header id="nav-bar" class="container">
    <div class="row">
        <div class="span12">
            <div id="header-container">
                <a id="backbutton" class="win-backbutton" href="index"></a>
                <h5><?php echo APP_NAME ?></h5>
                <div class="dropdown">
                    <a class="header-dropdown dropdown-toggle accent-color" data-toggle="dropdown" href="#" >
                        <?php echo  strtoupper($page)?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="index">Desktop</a></li>
                        <li><a href="accounts">Users</a></li>
                        <li><a href="department">Department</a></li>
                        <li><a href="staff">Staff</a></li>
                        <li><a href="clients">Clients</a></li>
                        <li><a href="agent">Agents</a></li>
                        <li><a href="complaint">Complaints</a></li>
                        <li><a href="tenant">Tenants</a></li>
                        <li class="divider"></li>
                        <li><a href="address">Address</a></li>
                        <li><a href="property">Property</a></li>
                        <li><a href="proptype">Property Types</a></li>
                        <li><a href="rent">Rents</a></li>
                        <li class="divider"></li>
                        <li><a href="index">Home</a></li>
                    </ul>
                </div>
            </div>
            <div id="top-info" class="pull-right dropdown">
                <a id="settings" href="#" class="win-command pull-right">
                    <span class="win-commandicon win-commandring icon-cog-3"></span>
                </a>
                <a id="logged-user" href="#" class="win-command pull-right dropdown-toggle" data-toggle="dropdown">
                    <span class="win-commandicon win-commandring icon-user"></span>
                </a>
                <div class="pull-left">
                    <h3><?php $system->getUser('user_first_name'); ?></h3>
                    <h4><?php $system->getUser('user_last_name'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</header>