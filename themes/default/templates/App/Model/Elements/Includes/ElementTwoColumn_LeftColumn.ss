<div
	class="element-two-column__column element-two-column__column--{$LeftColumnType.Lowercase} element-two-column__column--left trim">
	<% if $LeftColumnType == 'Image' && $LeftColumnImage %>
		{$LeftColumnImage.TwoColumnSet}
	<% else %>
		{$LeftColumnContent}

		<% if $RightColumnType == 'Image' %>
			<% if $ShowBall %>
				{$Ball}
			<% end_if %>
		<% end_if %>
	<% end_if %>
</div>
