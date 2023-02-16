<div class="header-wrapper" data-header-wrapper>
	<sticky-header>
		<header class="header">
			<div class="header__row">
				<a href="{$BaseURL}" class="header__logo">
					<img src="{$ThemeDir}/dist/images/branding/logo.png" alt="" width="200" height="82"/>
				</a>

				<div class="header__row--right">
<%--					<% include LocaleMenu %>--%>

					<nav class="nav">
						<ul class="nav__menu">
							<% loop $Menu(1) %>
								<li class="nav__item nav__item--{$LinkingMode}">
									<a class="nav__link" href="{$Link}"<% if $NewWindow %>
									   target="_blank"<% end_if %>>{$MenuTitle}</a>
									<% if $Children || $Categories %>
										<ul class="nav__submenu">
											<% if $Categories %>
												<% loop $Categories %>
													<li class="nav__subitem<% if $Top.CurrentCategory.ID == $ID%> nav__subitem--current<% end_if %>">
														<a class="nav__sublink" href="{$Link}">{$Title}</a>
													</li>
												<% end_loop %>
											<% end_if %>

											<% if $Children %>
												<% loop $Children %>
													<li class="nav__subitem nav__subitem--{$LinkingMode}">
														<a class="nav__sublink" href="{$Link}"<% if $NewWindow %>
														   target="_blank"<% end_if %>>{$MenuTitle}</a>
													</li>
												<% end_loop %>
											<% end_if %>
										</ul>
									<% end_if %>
								</li>
							<% end_loop %>
						</ul>
					</nav>
				</div>

				<button type="button" class="header__off-canvas-button" data-menu-toggler aria-expanded="false"
						aria-controls="nav">
					<span></span>
				</button>
			</div>
		</header>
	</sticky-header>
</div>
