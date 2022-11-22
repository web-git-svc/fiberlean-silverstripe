<div class="element-latest-posts<% if $Background == 'Blue' %> bg--blue-dark<% else %> bg--white<% end_if %>">
	<div class="container">
		<% if $TitleTag %>
			<div class="typography<% if $Background == 'Blue' %> typography--white<% end_if %>">
				{$TitleTag('center large')}
			</div>
		<% end_if %>

		<%--        <% if $LinkedPage.BlogPosts %>--%>
		<ul class="element-latest-posts__grid">
			<%--                <% loop $LinkedPage.BlogPosts %>--%>
			<li>
				<% include App\Includes\Card %>
			</li>

			<li>
				<% include App\Includes\Card %>
			</li>

			<li>
				<% include App\Includes\Card %>
			</li>
			<%--                <% end_loop %>--%>
		</ul>

		<div style="text-align: center">
			<a href="{$LinkedPage.Link}" class="button<% if $Background == 'White' %> button--blue-dark<% end_if %>">
				{$ButtonText}
			</a>
		</div>
		<%--        <% end_if %>--%>
	</div>
</div>
