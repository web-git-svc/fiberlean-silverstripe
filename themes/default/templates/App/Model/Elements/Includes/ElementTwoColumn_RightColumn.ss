<div
	class="element-two-column__column element-two-column__column--{$RightColumnType.Lowercase} element-two-column__column--right trim">
	<% if $RightColumnType == 'Image' && $RightColumnImage %>
		{$RightColumnImage.TwoColumnSet}
	<% else %>
		{$RightColumnContent}

		<% if $LeftColumnType == 'Image' %>
			<% if $ShowBall %>
				{$Ball}
			<% end_if %>
		<% end_if %>
	<% end_if %>
</div>
