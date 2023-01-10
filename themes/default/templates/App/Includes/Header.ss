<div class="header-wrapper" data-header-wrapper>
	<sticky-header>
		<header class="header">
			<div class="header__row">
				<a href="{$BaseURL}" class="header__logo">
					<img src="{$ThemeDir}/dist/images/branding/fibrelean.svg" alt="" width="250" height="82"/>
				</a>

				<div class="header__row--right">
					<% include LocaleMenu %>
					<nav class="nav">
						<ul class="nav__menu">
							<% loop $Menu(1) %>
								<li class="nav__item nav__item--{$LinkingMode}">
									<a class="nav__link" href="{$Link}">{$MenuTitle}</a>
									<% if $Children %>
										<ul class="nav__submenu">
											<% loop $Children %>
												<li class="nav__subitem nav__subitem--{$LinkingMode}">
													<a class="nav__sublink" href="{$Link}">{$MenuTitle}</a>
												</li>
											<% end_loop %>
										</ul>
									<% end_if %>
								</li>
							<% end_loop %>
						</ul>
					</nav>
				</div>

				<button type="button" class="header__off-canvas-button" data-menu-toggler aria-expanded="false" aria-controls="nav">
					<span></span>
				</button>
			</div>
		</header>
	</sticky-header>
</div>
