				<div class="widget">
					 <h2>Login/ Registration</h2>
					 <div class="inner">
						<form action="/login" method="post">
							<ul id='login'>
								<li>
									<input type="text" name="username" placeholder="username/email">
								</li>
								<li>
									<input type="password" name="password" placeholder="password">
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
								<a href="/register" class='white-link'>
									<li class='user-menu'>
										Register
									</li>
								</a>
								<li>
									Forgotten your <a href="/recover?mode=username">username</a> or <a href="/recover?mode=password">password</a>?
								</li>
							</ul>
						</form>
					 </div>
				</div>