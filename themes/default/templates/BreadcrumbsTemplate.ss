<% if $Pages %>
	<% if $Pages.Count > 1 %>
		<nav class="breadcrumbs" aria-label="Breadcrumb">
			<div class="container">
				<ol class="breadcrumbs__list">
					<% loop $Pages %>
						<li class="breadcrumbs__item">
							<a href="{$Link}"
							   class="breadcrumbs__link<% if $Last %> breadcrumbs__link--current<% end_if %>"<% if $Last %>
							   aria-current="page"<% end_if %>>
								{$MenuTitle.XML}
							</a>
						</li>
					<% end_loop %>
				</ol>
			</div>
		</nav>
	<% end_if %>

	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": [
			<% loop $Pages %>
			{
				"@type": "ListItem",
				"position": {$Pos},
				"name": "{$Title}"<% if $AbsoluteLink %>,<% end_if %>
		<% if $AbsoluteLink %>"item": "{$AbsoluteLink}"<% end_if %>
			}<% if not $Last %><% else %>]<% end_if %><% end_loop %>
		}


	</script>
<% end_if %>


