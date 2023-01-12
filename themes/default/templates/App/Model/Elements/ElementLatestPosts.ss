<div class="element-latest-posts<% if $Background == 'Blue' %> bg--blue-dark<% else %> bg--white<% end_if %>">
	<div class="container">
		<% if $TitleTag %>
			<div class="typography<% if $Background == 'Blue' %> typography--white<% end_if %>">
				{$TitleTag('center large')}
			</div>
		<% end_if %>
		<% if $LinkedCategory.BlogPosts %>
			<ul class="element-latest-posts__grid no-list">
				<% loop $LinkedCategory.BlogPosts.Limit(3) %>
					<li>
						<% include App\Includes\Card %>
					</li>
				<% end_loop %>
			</ul>
		<% else %>
			<ul class="element-latest-posts__grid no-list">
				<% loop $LatestPosts %>
					<li>
						<% include App\Includes\Card %>
					</li>
				<% end_loop %>
			</ul>
		<% end_if %>

		<div style="text-align: center">
			<a href="<% if $LinkedCategory.BlogPosts %>{$LinkedCategory.Link} <% else %>{$LinkedPage.Link} <% end_if %>" class="button<% if $Background == 'White' %> button--blue-dark<% end_if %>">
				{$ButtonText}
			</a>
		</div>
	</div>
</div>
