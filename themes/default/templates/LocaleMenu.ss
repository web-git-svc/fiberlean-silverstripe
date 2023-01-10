<% if $Locales %>
	<div class="fluent__outer">
		<div class="fluent__inner">
			<% loop $Locales %>
				<% if $LinkingMode == 'current' %>
					<button class="fluent__button">
						<img class="fluent__image" src="{$ThemeDir}/dist/images/fluent/{$Locale.Lowercase}.png" alt="{$Title}"/>
						<span>{$Title}</span>
						{$SVGIcon('locales-arrow', 10, 10)}
					</button>
				<% end_if %>
			<% end_loop %>
			<ul class="fluent__list fluent__list--hidden">
				<% loop $Locales %>
					<li class="$LinkingMode">
						<a href="$Link.ATT" <% if $LinkingMode != 'invalid' %>rel="alternate" hreflang="$HrefLang"<% end_if %>>
							<img class="fluent__image" src="{$ThemeDir}/dist/images/fluent/{$Locale.Lowercase}.png" alt="{$Title}"/>
							<span>$Title.XML</span>
						</a>
					</li>
				<% end_loop %>
			</ul>
		</div>
	</div>
<% end_if %>
