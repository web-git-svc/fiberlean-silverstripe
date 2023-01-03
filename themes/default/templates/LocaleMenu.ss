<% if $Locales %>
	<div class="left">
		<nav class="primary">
			<% loop $Locales %>
				<% if $LinkingMode == 'current' %>
					<button>{$Title}</button>
				<% end_if %>
			<% end_loop %>
			<ul>
				<% loop $Locales %>
					<li class="$LinkingMode">
						<img class="fluent__image" src="{$ThemeDir}/dist/images/fluent/{$URLSegment.Lowercase}.png" alt="{$Title}"/>
						<a href="$Link.ATT" <% if $LinkingMode != 'invalid' %>rel="alternate"
						   hreflang="$HrefLang"<% end_if %>>$Title.XML</a>
					</li>
				<% end_loop %>
			</ul>
		</nav>
	</div>
<% end_if %>
