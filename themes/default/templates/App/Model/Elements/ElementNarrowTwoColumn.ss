<div class="element-narrow-two-column">
	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<div class="container typography">
		<% if $TitleTag %>
			{$TitleTag('center')}
		<% end_if %>

		<div class="element-narrow-two-column__row<% if $ReverseOrderOnMobile %> element-narrow-two-column__row--reverse<% end_if %>">
			<% if $ReverseOrderOnMobile %>
				<% include App\Model\Elements\Includes\ElementNarrowTwoColumn_RightColumn %>
				<% include App\Model\Elements\Includes\ElementNarrowTwoColumn_LeftColumn %>
			<% else %>
				<% include App\Model\Elements\Includes\ElementNarrowTwoColumn_LeftColumn %>
				<% include App\Model\Elements\Includes\ElementNarrowTwoColumn_RightColumn %>
			<% end_if %>
		</div>
	</div>
</div>
