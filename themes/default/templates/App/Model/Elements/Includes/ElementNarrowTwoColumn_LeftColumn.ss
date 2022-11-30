<div
	class="element-narrow-two-column__column element-narrow-two-column__column--{$LeftColumnType.Lowercase} element-narrow-two-column__column--left trim">
	<% if $LeftColumnType == 'Image' && $LeftColumnImage %>
		{$LeftColumnImage.TwoColumnSet}
	<% else %>
		{$LeftColumnContent}
	<% end_if %>
</div>
