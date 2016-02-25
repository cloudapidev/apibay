<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset ("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{Session::get("account_info")->full_name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
 
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview dashboard">
              <a href="{{ url("/") }}">
                <i class="fa fa-dashboard"></i> <span>{{ trans('layout.Dashboard') }}</span>
              </a>
            </li>
						<li class="treeview menu_documentation">
              <a href="number-listing.php">
                <i class="fa fa fa-book"></i>
                <span>{{ trans('layout.Documentation') }}</span>
				 <i class="fa fa-angle-left pull-right"></i>
              </a>
				<ul class="treeview-menu">
					<li class="menu_documentation_phonenumber"><a href="{{ url("documentation/phonenumber") }}">{{ trans('layout.Phone Numbers') }}</a></li>
					<li class="menu_documentation_serverapp"><a href="{{ url("documentation/serverapp") }}">{{ trans('layout.Server Apps') }}</a></li>
					<li class="menu_documentation_clientapp"><a href="{{ url("documentation/clientapp") }}">{{ trans('layout.Client Apps') }}</a></li>
					<li class="menu_documentation_billing"><a href="{{ url("documentation/billing") }}">{{ trans('layout.Billing & Reports') }}</a></li>
					<li class="menu_documentation_setting"><a href="{{ url("documentation/setting") }}">{{ trans('layout.Settings') }}</a></li>
				</ul>
              </a>
            </li>
						<li class="treeview menu_number">
              <a href="number-listing.php">
                <i class="fa fa fa-phone-square"></i>
                <span>{{ trans('layout.Phone Numbers') }}</span>
								 <i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
                <li class="menu_number_listing"><a href="{{ url("numbers") }}">{{ trans('layout.Listing') }}</a></li>
                <li class="menu_number_new"><a href="{{ url("numbers/buy") }}">{{ trans('layout.Buy Phone Number') }}</a></li>
              </ul>
            </li>
						
						<li class="treeview menu_user">
              <a href="{{ url('/') }}">
                <i class="fa fa-user-plus"></i> <span>{{ trans('layout.Users') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
                <li class="menu_user_listing"><a href="{{ url("users") }}">{{ trans('layout.Listing') }}</a></li>
                <li class="menu_user_new"><a href="{{ url("users/add") }}">{{ trans('layout.Create New') }}</a></li>
              </ul>
            </li>
						
						<li class="treeview menu_serverapp">
              <a href="url('/')">
                <i class="fa fa-server"></i> <span>{{ trans('layout.Server Apps') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
                <li class="menu_serverapp_listing"><a href="{{url("serverapps")}}">{{ trans('layout.Listing') }}</a></li>
                <li class="menu_serverapp_new"><a href="{{url("serverapps/add")}}">{{ trans('layout.Create New') }}</a></li>
							</ul>
            </li>
						
						<li class="treeview menu_siptrunk">
              <a href="url('/')">
                <i class="fa fa-whatsapp"></i> <span>{{ trans('layout.Sip Trunk') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
                <li class="menu_siptrunk_listing"><a href="{{url("siptrunk")}}">{{ trans('layout.Listing') }}</a></li>
<!--                 <li class="menu_siptrunk_new"><a href="{{url("siptrunk/add")}}">{{ trans('layout.Create New') }}</a></li> -->
							</ul>
            </li>
            
            
            
            <li class="treeview menu_clientapp">
              <a href="url('/')">
                <i class="fa fa-server"></i> <span>{{ trans('layout.Client Apps') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
                <li class="menu_clientapp_listing"><a href="{{url("clientapps")}}">{{ trans('layout.Listing') }}</a></li>
                <li class="menu_clientapp_new"><a href="{{url("clientapps/add")}}">{{ trans('layout.Create New') }}</a></li>
							</ul>
            </li>
						
						<li class="treeview menu_pricing">
              <a href="url('/')">
                <i class="fa fa-object-ungroup"></i> <span>{{ trans('layout.Pricing') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
								<ul class="treeview-menu">
									<li class="menu_pricing_rate"><a href="{{url("pricing")}}">{{ trans('layout.Call/SMS Rates') }}</a></li>
								</ul>
              </a>
            </li>
						
						<li class="treeview menu_extra">
              <a href="url('/')">
                <i class="fa fa-object-ungroup"></i> <span>{{ trans('layout.Extras') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
								<ul class="treeview-menu">
									<li class="menu_extra_call"><a href="{{url("callout")}}">{{ trans('layout.Make Call') }}</a></li>
									<li class="menu_extra_sms"><a href="{{url("sendsms")}}">{{ trans('layout.Send SMS') }}</a></li>
								</ul>
              </a>
            </li>
						
						<li class="treeview">
              <a href="url('/')">
                <i class="fa fa-bar-chart"></i> <span>{{ trans('layout.Billing & Reports') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
								<ul class="treeview-menu">
									<li class="sssss"><a href="{{url("calllogs")}}">{{ trans('layout.Call Logs') }}</a></li>
									<li class="sssss"><a href="{{url("smslogs")}}">{{ trans('layout.SMS Logs') }}</a></li>
									<li class="sssss"><a href="{{url("statements")}}">{{ trans('layout.Statements') }}</a></li>
									<li class="sssss"><a href="{{url("topup")}}">{{ trans('layout.Topup & Payments History') }}</a></li>		
								</ul>
              </a>
            </li>
						
						<li class="treeview menu_setting">
              <a href="url('/')">
                <i class="fa fa-gear"></i> <span>{{ trans('layout.Settings') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
								<ul class="treeview-menu">
                <li class="menu_account"><a href="{{url("account")}}">{{ trans('layout.Account') }}</a></li>
                <li class="menu_channel_listing"><a href="{{url("channel")}}">{{ trans('layout.Channel ( SIP Trunk )') }}</a></li>
                <li class="menu_channel_listing"><a href="{{url("channel")}}">{{ trans('layout.Channel ( Number )') }}</a></li>
              </ul>
              </a>
            </li>
						
						<li class="treeview">
              <a href="url('/')">
                <i class="fa fa-gears"></i> <span>{{ trans('layout.System(Admin Only)') }}</span>
								<i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage Numbers') }}</a></li>
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage Accounts') }}</a></li>
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage Administrators') }}</a></li>
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage Countries') }}</a></li>
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage Topups') }}</a></li>
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage SIP Trunks') }}</a></li>
                <li class="aaaa"><a href="url('/')">{{ trans('layout.Manage Rate Table') }}</a></li>
              </ul>
            </li>
						
            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
						
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>