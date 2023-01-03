<div class="post-summary <% if $Even %>post-summary--reverse<% end_if %>">
	<% if $Odd %>
		<div class="post-summary__column post-summary__column--left post-summary__column--image trim">
			{$FeaturedImage.TwoColumnSet}
		</div>

		<div class="post-summary__column post-summary__column--right">
			<a class="post-summary__title" href="$Link" title="{$Title}">
				<% if $MenuTitle %>$MenuTitle
				<% else %>$Title<% end_if %>
			</a>

			<div class="post-summary__date">
				<p>Posted in
					<% if $Categories %>
						<% with $Categories.First %>
							<a href="{$Link}">{$Title}</a>
						<% end_with %>
					<% else %>
						<a href="{$Parent.Link}">News</a>
					<% end_if %> on {$PublishDate.Format('dd MMMM YYYY')}</p>
			</div>

			<div class="post-summary__summary">
				<% if $Summary %>
					$Summary
				<% else %>
					<p>$Excerpt</p>
				<% end_if %>

				{$SVGIcon('arrow-circle', 50, 50)}
			</div>
		</div>
	<% else %>
		<div class="post-summary__column post-summary__column--left">
			<a class="post-summary__title" href="$Link" title="{$Title}">
				<% if $MenuTitle %>$MenuTitle
				<% else %>$Title<% end_if %>
			</a>

			<div class="post-summary__date">
				<p>Posted in <a href="#">News</a> on {$PublishDate.Format('dd MMMM YYYY')}</p>
			</div>

			<div class="post-summary__summary">
				<% if $Summary %>
					$Summary
				<% else %>
					<p>$Excerpt</p>
				<% end_if %>

				{$SVGIcon('arrow-circle', 50, 50)}
			</div>
		</div>

		<div class="post-summary__column post-summary__column--right post-summary__column--image trim">
			{$FeaturedImage.TwoColumnSet}
		</div>
	<% end_if %>
</div>
