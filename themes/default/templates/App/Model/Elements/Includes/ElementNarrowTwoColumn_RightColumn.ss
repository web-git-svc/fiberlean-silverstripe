<div
	class="element-narrow-two-column__column element-narrow-two-column__column--{$RightColumnType.Lowercase} element-narrow-two-column__column--right trim">
	<% if $RightColumnType == 'Image' && $RightColumnImage %>
		{$RightColumnImage.TwoColumnSet}
	<% else %>
		{$RightColumnContent}
	<% end_if %>
</div>
