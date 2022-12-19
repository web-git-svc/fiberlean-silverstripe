<div class="blog">
	<div class="container">
		<div class="blog__top typography">
			<h1 class="blog__title">{$Title}</h1>
		</div>
		<% if $PaginatedList.Exists %>
			<div class="blog-list">
				<% loop $PaginatedList %>
					<% include SilverStripe\Blog\Includes\PostSummary %>
				<% end_loop %>
			</div>
		<% else %>
			<p class="blog-list--empty">Sorry, there are no posts</p>
		<% end_if %>

		<% with $PaginatedList %>
			<% include SilverStripe\Blog\Includes\Pagination %>
		<% end_with %>
	</div>
	{$ElementalArea}
</div>
