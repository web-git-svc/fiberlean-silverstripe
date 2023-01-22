<ul<% if $TopLevel %> class="sitemap__top-level"<% end_if %>>
	<% loop $Pages %>
		<li>
			<% if $Up.TopLevel %>
				<h2  class="sitemap__heading">
					<a href="{$Link}">{$MenuTitle}</a>
				</h2>
			<% else %>
				<a class="sitemap__link" href="{$Link}">{$MenuTitle}</a>
			<% end_if %>

			<% if $Children %>
				<% include App\Model\Sitemap\Includes\PageList Pages=$Children %>
			<% end_if %>
		</li>
	<% end_loop %>
</ul>
