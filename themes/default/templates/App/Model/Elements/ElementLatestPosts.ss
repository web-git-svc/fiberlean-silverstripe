<div class="element-latest-posts<% if $Background == 'Blue' %> bg--blue-dark<% else %> bg--white<% end_if %> <% if $BlockFormat == 'Compact' %>element-latest-posts--compact<% end_if %>">
	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<% if $BlockFormat == 'Grid' %>
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
	<% else %>
		<div class="element-latest-posts__compact">
			<% if $TitleTag %>
				<div class="element-latest-posts__compact-title typography<% if $Background == 'Blue' %> typography--white<% end_if %>">
					{$TitleTag('center large')}
				</div>
			<% end_if %>
			<% if $LinkedCategory.BlogPosts %>
				<% with $LinkedCategory.BlogPosts.First %>
					<div class="element-latest-posts__compact-content">
						<h3 class="element-latest-posts__compact-content-title">
							<a href="{$Link}">
								{$Title.LimitCharactersToClosestWord('45')}
							</a>
						</h3>

						<time class="element-latest-posts__compact-date" datetime="{$PublishDate}">
							{$PublishDate.Format('dd MMMM yyyy')}
							<span class="element-latest-posts__compact-arrow">
								<svg width="20" height="18">
									<use xlink:href="{$ThemeDir}/dist/images/icons.svg#icon-arrow"></use>
								</svg>
							</span>
						</time>
					</div>
					<div class="element-latest-posts__compact-image">
						{$FeaturedImage.ScaleWidth(360, 223)}
					</div>
				<% end_with %>
			<% end_if %>
		</div>
	<% end_if %>
</div>

