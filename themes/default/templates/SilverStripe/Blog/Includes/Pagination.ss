<%-- NOTE: Before including this, you will need to wrap the include in a with block  --%>

<% if $MoreThanOnePage %>
	<div class="container">
		<div class="pagination">
			<a class="pagination__link pagination__link--prev <% if $FirstPage %>pagination__link--inactive<% end_if %>" href="{$PrevLink}">
				{$SVGIcon('arrow-circle', 50, 50)}
			</a>

			<% loop $PaginationSummary(4) %>
				<% if $CurrentBool %>
					<a href="$Link" class="pagination__link pagination__link--current">$PageNum</a>
				<% else %>
					<% if $Link %>
						<a href="$Link" class="pagination__link">$PageNum</a>
					<% else %>
						<span>...</span>
					<% end_if %>
				<% end_if %>
			<% end_loop %>


			<a class="pagination__link pagination__link--next <% if $LastPage %>pagination__link--inactive<% end_if %>" href="{$NextLink}">
				{$SVGIcon('arrow-circle', 50, 50)}
			</a>
		</div>
	</div>
<% end_if %>
