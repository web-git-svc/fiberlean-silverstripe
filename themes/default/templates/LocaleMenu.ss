<% if $Locales %>
	<div class="fluent__outer">
		<div class="fluent__inner">
			<% with $CurrentLocaleObject %>
				<button class="fluent__button fluent__option">
					<% if $Flag %>
						<span class="fluent__image">
							{$Flag.FocusFill(30, 30)}
						</span>
					<% end_if %>

					<span class="fluent__title">
						{$Title}
					</span>

					{$SVGIcon('locales-arrow', 10, 10)}
				</button>
			<% end_with %>

			<ul class="fluent__list fluent__list--hidden">
				<% loop $Locales %>
					<% if $CurrentLocaleObject.HrefLang != $HrefLang %>
						<li class="{$LinkingMode}">
							<a
								href="{$Link.ATT}"
								<% if $LinkingMode != 'invalid' %>
								rel="alternate" hreflang="{$HrefLang}"
								<% end_if %>
								class="fluent__option"
							>
								<% if $LocaleObject.Flag %>
									<span class="fluent__image">
										{$LocaleObject.Flag.FocusFill(30, 30)}
									</span>
								<% end_if %>

								<span>
								{$Title.XML}
							</span>
							</a>
						</li>
					<% end_if %>
				<% end_loop %>
			</ul>
		</div>
	</div>
<% end_if %>
