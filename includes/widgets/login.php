				<div class="widget">
					 <h2>Login/ Registration</h2>
					 <div class="inner">
						<form action="/login" method="post">
							<ul id='login'>
								<li>
									Username:<br/>
									<input type="text" name="username">
								</li>
								<li>
									Password:<br/>
									<input type="password" name="password">
								</li>
								<li>
									<input type="submit" value='Log in'> 
										<label class="custom-check">
											<input class="custom-check__checkbox check-B" name="save" type="checkbox" value='1'>
											<span data-ripple="false" class="custom-check__checkbox check-B__background">
											</span>
											<span class="custom-check__checkbox check-B__checkbox">
											</span>
											<span style='margin-left: 25px;font:normal 12px/1.8em Arial, Helvetica, sans-serif;'>Keep me logged in</span>
										</label>
								</li>
								<li class='user-menu'>
									<a href="/register">Register</a>
								</li>
								<li>
									Forgotten your <a href="/recover?mode=username">username</a> or <a href="/recover?mode=password">password</a>?
								</li>
							</ul>
						</form>
					 </div>
				</div>