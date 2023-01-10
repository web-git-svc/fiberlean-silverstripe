<footer class="footer bg--blue-dark typography--white">
	<div class="container">
		<div class="footer__row">
			<% with $SiteConfig %>
				<% if $FacebookURL || $TwitterURL || $LinkedInURL %>
					<ul class="footer__socials">
						<% if $FacebookURL %>
							<li>
								<a href="{$FacebookURL}" target="_blank" title="Follow us on Facebook">
									{$SVGIcon('facebook', 43, 43)}
								</a>
							</li>
						<% end_if %>

						<% if $TwitterURL %>
							<li>
								<a href="{$TwitterURL}" target="_blank" title="Follow us on Twitter">
									{$SVGIcon('twitter', 43, 43)}
								</a>
							</li>
						<% end_if %>

						<% if $LinkedInURL %>
							<li>
								<a href="{$LinkedInURL}" target="_blank" title="Follow us on LinkedIn">
									{$SVGIcon('linkedin', 43, 43)}
								</a>
							</li>
						<% end_if %>
					</ul>
				<% end_if %>
			<% end_with %>

			<div class="footer__content">
				<div class="typography typography--white">
					<p>
						&copy; {$Now.Format('Y')} {$SiteConfig.Title}
					</p>

					{$SiteConfig.FooterContent}
				</div>

				<% if $MenuSet('Footer').MenuItems %>
					<ul class="footer__menu">
						<% loop $MenuSet('Footer').MenuItems %>
							<li><a href="{$Link}"<% if $IsNewWindow %> target="_blank" <% end_if %>>{$MenuTitle}</a></li>
						<% end_loop %>
					</ul>
				<% end_if %>
			</div>
		</div>
	</div>
</footer>

<% include App\Model\Elements\ElementRibbon %>
