<div
	class="element-narrow-two-column__column element-narrow-two-column__column--{$LeftColumnType.Lowercase} element-narrow-two-column__column--left trim">
	<% if $LeftColumnType == 'Image' && $LeftColumnImage %>
		<% if $LeftImageScaleWidth %>
			{$LeftColumnImage.ScaleWidth(456, 343)}
		<% else %>
			{$LeftColumnImage.TwoColumnSet}
		<% end_if %>
	<% else %>
		{$LeftColumnContent}
	<% end_if %>
</div>
