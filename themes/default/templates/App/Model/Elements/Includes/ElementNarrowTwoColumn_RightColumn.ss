<div
	class="element-narrow-two-column__column element-narrow-two-column__column--{$RightColumnType.Lowercase} element-narrow-two-column__column--right trim">
	<% if $RightColumnType == 'Image' && $RightColumnImage %>
		<% if $RightImageScaleWidth %>
			{$RightColumnImage.ScaleWidth(456, 343)}
		<% else %>
			{$RightColumnImage.TwoColumnSet}
		<% end_if %>
	<% else_if $RightColumnType == 'Video' && $RightColumnVideo %>
		{$RightColumnVideo}
	<% else %>
		{$RightColumnContent}
	<% end_if %>
</div>
