<div class="element-narrow-content element-narrow-content--{$BackgroundColour}">
	<% if $CircleColour != 'None' %>
		<div class="element-narrow-content__circle element-narrow-content__circle--{$CircleColour.Lowercase}">
			{$SVGIcon('semi-circle', 1575, 2089)}
		</div>
	<% end_if %>

	<div class="container container--narrow typography trim">
		{$TitleTag}

		{$HTML}
	</div>
</div>
