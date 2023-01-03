<div class="blog">
	<div class="container">
		<div class="blog__top typography">
			<h1 class="blog__title">{$Title}</h1>

			<label for="categories"></label>
			<select name="categories" id="categories" class="blog__category-select" onchange="window.location = this.value">
				<option value="{$Link}">View all News & Media</option>
				<% loop $Categories %>
					<option value="{$Link}" <% if $Top.CurrentCategory.ID == $ID %>selected<% end_if %>>{$Title}</option>
				<% end_loop %>
			</select>

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
