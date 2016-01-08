<?php if(isset($_GET['type']))$type = $_GET['type']; ?>

<!-- Type siptrunk add authentication -->
<?php if($type=="siptrunkaddauthentication"){ ?>
			<form class="form-horizontal">
				

						<div class="box-body">
						
							<div class="form-group">
								<label class="col-xs-3">Enter username</label>
								
								<div class="col-xs-4">
									<input type="text" class="form-control" placeholder="Enter ...">
								</div>
								
							</div>
							
							<div class="form-group margin">
								<label class="col-xs-3">Enter password</label>
								
								<div class="col-xs-4">
									<input type="password" class="form-control" placeholder="Enter ...">
								</div>
								
							</div>

						</div>
						<div class="box-footer">
								<div class="pull-left">
										<a href="#" class="btn bg-maroon btn-flat margin" data-dismiss="modal">Save</a>
								</div>	
								
								<div class="pull-right">
										<a href="#" class="btn btn-danger margin" data-dismiss="modal">Delete</a>
								</div>
						</div>
		
			</form>
<?php } ?>
<!-- End Type siptrunk add authentication -->

<!-- Type apisdk -->
<?php if($type=="apisdk"){ ?>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla volutpat turpis arcu, nec ultricies tellus vulputate ac. Nullam nec consequat sapien, ut ornare lorem. Aenean turpis leo, pretium in semper ac, mattis non libero. Aenean fermentum mauris a viverra congue. Duis lacinia, nisl sit amet scelerisque vulputate, neque quam pretium est, aliquet euismod eros tellus sed tortor. Maecenas efficitur augue vitae lorem facilisis tincidunt. Nullam mollis velit est, et faucibus nunc eleifend eu. Vestibulum consectetur, nibh sit amet venenatis lacinia, nisl tortor iaculis diam, at dictum eros elit sodales odio. Ut eros nunc, rutrum in semper ac, tempor vel nisi. Donec tempor mollis mollis. Aliquam a facilisis metus, eu malesuada magna. Vivamus ultrices pharetra tellus eu venenatis. Nullam vitae mi sit amet diam efficitur pharetra id in quam. Fusce cursus ultricies elit, sit amet lacinia ante vulputate at. Aliquam mattis venenatis dui, eu luctus tellus egestas sit amet.</p>

<p>Morbi dignissim vehicula ligula, sed dictum lacus elementum quis. Etiam vel arcu viverra, varius quam eget, facilisis odio. Cras et odio hendrerit nunc pulvinar fringilla. Integer volutpat est at est bibendum cursus id ac enim. Vestibulum sit amet nunc ipsum. Aenean maximus risus eu ullamcorper bibendum. Vestibulum convallis lacus lorem, ac pretium ante elementum ut. Integer condimentum egestas orci, sit amet tincidunt nulla eleifend eget. Nullam venenatis imperdiet interdum. Praesent vulputate vehicula libero ac elementum. Duis convallis semper elit, imperdiet feugiat nunc vulputate id. Donec eget bibendum enim. Maecenas a tortor risus.</p>																		
<?php } ?>
<!-- End Type apisdk -->


<!-- Type sdk -->
<?php if($type=="sdk"){ ?>

	<fieldset>
			<legend><h1>Twilio Class Reference</h1></legend>

		<div id="md" class="docs">
			<h3>Overview</h3>
			<ul>
				<li>Package: <code class="notranslate">com.twilio.client</code></li>
				<li>Subclass of: <code class="notranslate">Object</code></li>
			</ul>
			<p>Abstract class used to initialize and shut down the Twilio Client SDK.</p>
		<h3>Nested Classes</h3>
		<ul>
			<li><a href="Twilio.InitListener">InitListener</a></li>
		</ul>
		<h3 id="tasks-header"><a href="#tasks-header">Tasks</a></h3>
		<table>
			<thead>
				<tr>
				<th align="left">Name</th>
				<th align="left">Description</th>
				<th align="left">Type</th>
				</tr>
			</thead>
			<tbody>
			<tr>
			<td class="notranslate" align="left"><a href=
			"#initialize_Context__Twilio_InitListener_">initialize</a></td>
			<td align="left">Initialize the Twilio Client SDK.</td>
			<td align="left">Static method</td>
			</tr>
			<tr>
				<td class="notranslate" align="left"><a href=
				"#shutdown__">shutdown</a></td>
				<td align="left">Shuts down the Twilio Client SDK.</td>
				<td align="left">Static method</td>
			</tr>
			<tr>
				<td class="notranslate" align="left"><a href=
				"#isInitialized__">isInitialized</a></td>
				<td align="left">Determines if the Twilio Client SDK has been
				initialized or not.</td>
				<td align="left">Static method</td>
			</tr>
			<tr>
				<td class="notranslate" align="left"><a href=
				"#createDevice_String__DeviceListener_">createDevice</a></td>
				<td align="left">Create and initialize a new Device object.</td>
				<td align="left">Static method</td>
			</tr>
			<tr>
				<td class="notranslate" align="left"><a href=
				"#listDevices__">listDevices</a></td>
				<td align="left">Retrieves a list of all active <a href=
				"Device"><code class="notranslate">Device</code></a>s.</td>
				<td align="left">Static method</td>
			</tr>
			</tbody>
		</table>
		<h3>Methods</h3>
		<h4 id="initialize_Context__Twilio_InitListener_"><a href=
		"#initialize_Context__Twilio_InitListener_"><code class=
		"notranslate">void initialize(Context inContext, InitListener
		inListener)</code></a></h4>
		<p>Initialize the Twilio Client SDK.</p>
		<p>The SDK needs to start an Android Service to handle voice. When
		this service has been started, a Device can be created and
		used.</p>
		<h5>Parameters</h5>
		<table>
			<thead>
				<tr>
				<th align="left">Name</th>
				<th align="left">Description</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td class="notranslate" align="left"><code class=
				"notranslate">inContext</code></td>
				<td align="left">The Application Context from your Android app.
				Make sure you don't pass an Activity Context. You can retrieve the
				Application Context by calling getApplicationContext() on your
				Activity. Cannot be null.</td>
			</tr>
			<tr>
				<td class="notranslate" align="left"><code class=
				"notranslate">inListener</code></td>
				<td align="left">A <a href="Twilio.InitListener"><code class=
				"notranslate">InitListener</code></a> that will notify you when the
				service is ready. Cannot be null.</td>
			</tr>
			</tbody>
		</table>
		<h5>Return Value</h5>
		<p>None</p>
		<hr />
		<h4 id="shutdown__"><a href="#shutdown__"><code class=
		"notranslate">void shutdown()</code></a></h4>
		<p>Shuts down the Twilio Client SDK.</p>
		<p>This will terminate all connections, release all Device objects,
		and release any resources used by the SDK.</p>
		<p>Note that any attempt to access existing Device or Connection
		objects after calling this method may cause an exception to be
		thrown, or a crash.</p>
		<h5>Return Value</h5>
		<p>None</p>
		<hr />
		<h4 id="isInitialized__"><a href="#isInitialized__"><code class=
		"notranslate">boolean isInitialized()</code></a></h4>
		<p>Determines if the Twilio Client SDK has been initialized or
		not.</p>
		<p>If you expect your application to run in the background when the
		user has switched to other applications, you will want to check the
		return value of this method on startup. The Android OS may have
		killed your application due to memory pressure, but the SDK may
		still be running in the background.</p>
		<h5>Return Value</h5>
		<p>true if the SDK is currently initialized, false otherwise</p>
		<hr />
		<h4 id="createDevice_String__DeviceListener_"><a href=
		"#createDevice_String__DeviceListener_"><code class=
		"notranslate">Device createDevice(String inCapabilityToken,
		DeviceListener inListener)</code></a></h4>
		<p>Create and initialize a new Device object.</p>
		<p>If the incoming capabilities are defined, then the device will
		automatically begin listening for incoming connections.</p>
		<h5>Parameters</h5>
		<table>
			<thead>
				<tr>
					<th align="left">Name</th>
					<th align="left">Description</th>
				</tr>
			</thead>
		<tbody>
		<tr>
			<td class="notranslate" align="left"><code class=
			"notranslate">inCapabilityToken</code></td>
			<td align="left">A signed JSON Web Token that defines the features
			available to the Device. These may be created using the Twilio
			Helper Libraries included with the SDK or available at <a href=
			"http://www.twilio.com">www.twilio.com</a>. The capabilities are
			used to begin listening for incoming connections and provide the
			default parameters used for establishing outgoing connections.
			Please visit <a href=
			"http://www.twilio.com/docs/client/capability-tokens">http://www.tw
			ilio.com/docs/client/capability-tokens</a> for more
			information.</td>
		</tr>
		<tr>
		<td class="notranslate" align="left"><code class=
		"notranslate">inListener</code></td>
		<td align="left">The optional listener object which will receive
		events from a Device object.</td>
		</tr>
		</tbody>
		</table>
			<h5>Return Value</h5>
			<p>The initialized Device object, or null if the SDK was not
			initialized</p>
			<h4 id="listDevices__"><a href="#listDevices__"><code class=
			"notranslate">List&lt;&gt; listDevices()</code></a></h4>
			<p>Retrieves a list of all active <a href="Device"><code class=
			"notranslate">Device</code></a>s.</p>
			<h5>Return Value</h5>
			<p>An unmodifiable <code class="notranslate">List</code> of
			<a href="Device"><code class="notranslate">Device</code></a>
			objects</p>
			<h4><code class="notranslate">public static void setLogLevel(int
			level)</code></h4>
			<p>Sets the logging level for messages logged by the Twilio
			SDK.</p>
			<p>Log levels correspond to those specified by Android's <a href=
			"http://developer.android.com/reference/android/util/Log.html?is-ex%20ternal=true"
			title="class or interface in android.util"><code>Log</code></a>
			class.</p>
			<p>To disable all Twilio SDK logging, set this to <a href=
			"http://developer.android.com/reference/android/util/Log.html?is-ex%20ternal=true#ASSERT"
			title=
			"class or interface in android.util"><code>Log.ASSERT</code></a>.
			The default is <a href=
			"http://developer.android.com/reference/android/util/Log.html?is-ex%20ternal=true#ERROR"
			title=
			"class or interface in android.util"><code>Log.ERROR</code></a>.</p>
			<h4><code class="notranslate">public static void setMetrics(boolean
			enable)</code></h4>
			<p>Toggle the call quality analytics publishing feature of the
			Twilio SDK. This is enabled by default.</p>
		</div>
		
</fieldset>
		
	<?php } ?>
	
	<!-- End Type sdk -->