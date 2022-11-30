<div class="element-two-column<% if $BallColour != 'None' %> element-two-column--padding-bottom ball--{$BallColour.Lowercase}<% end_if %>">
	<% include App\Model\Elements\Includes\Before %>

	<div class="container typography">
		<div class="element-two-column__row<% if $ReverseOrderOnMobile %> element-two-column__row--reverse<% end_if %>">
			<% if $ReverseOrderOnMobile %>
				<% include App\Model\Elements\Includes\ElementTwoColumn_RightColumn %>
				<% include App\Model\Elements\Includes\ElementTwoColumn_LeftColumn %>
			<% else %>
				<% include App\Model\Elements\Includes\ElementTwoColumn_LeftColumn %>
				<% include App\Model\Elements\Includes\ElementTwoColumn_RightColumn %>
			<% end_if %>
		</div>
	</div>

	<% include App\Model\Elements\Includes\After %>
</div>
