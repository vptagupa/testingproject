<aside id="left-sidebar-nav">
<ul id="slide-out" class="side-nav fixed leftside-navigation">
    <li class="user-details cyan darken-2">
    <div class="row">
        <div class="col col s4 m4 l4">
            <img src="{{ asset('assets/images/avatar.jpg') }}" alt="" class="circle responsive-img valign profile-image">
        </div>
        <div class="col col s8 m8 l8">
            <ul id="profile-dropdown" class="dropdown-content">
                <li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
                </li>
                <li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                </li>
                <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                </li>
                <li class="divider"></li>
                <li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
                </li>
                <li><a href="#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                </li>
            </ul>
            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">John Doe<i class="mdi-navigation-arrow-drop-down right"></i></a>
            <p class="user-roal">Administrator</p>
        </div>
    </div>
    </li>
    <li class="bold"><a href="#dashboard" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
    </li>
    <li class="bold">
      <ul class="collapsible collapsible-accordion">
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-image-flash-on"></i> Manager</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#vendor"><i class="mdi-editor-format-align-right"></i> Vendor</a>
                        </li>
                        <li><a href="#departments"><i class="mdi-editor-insert-emoticon"></i> Departments </a>
                        </li>
                        <li><a href="#active-users"><i class="mdi-action-verified-user"></i>Active Users </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li class="bold"><a href="index.html" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> General Settings</a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Security</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#/security/users"><i class="mdi-action-account-circle"></i> Users</a>
                        </li>
                        <li><a href="#user-access"><i class="mdi-action-accessibility"></i>User Rights</a>
                        </li>
                        <li><a href="#agency-profile"><i class="mdi-action-account-box"></i>Agency Profile</a>
                        </li>
                        <li><a href="#password-config"><i class="mdi-action-settings-input-antenna"></i>Password</a>
                        </li>
                        <li><a href="#settings"><i class="mdi-action-settings"></i>Settings</a>
                        </li>
                        <li><a href="#backup"><i class="mdi-action-backup"></i>Backup</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-file-folder-shared"></i> Logs</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#audittrails"><i class="mdi-editor-format-align-right"></i> Transaction</a>
                        </li>
                        <li><a href="#visited-module"><i class="mdi-editor-insert-emoticon"></i>Visited Module </a>
                        </li>
                        <li><a href="#active-users"><i class="mdi-action-verified-user"></i>Active Users </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li class="bold"><a href="index.html" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Help</a>
    </li>
    <li class="bold"><a href="index.html" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Support</a>
    </li>
    <li class="li-hover"><div class="divider"></div></li>
    <li class="li-hover"><p class="ultra-small margin more-text">Daily Sales</p></li>
    <li class="li-hover">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="sample-chart-wrapper">                            
                    <div class="ct-chart ct-golden-section" id="ct2-chart"></div>
                </div>
            </div>
        </div>
    </li>
</ul>
<a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>