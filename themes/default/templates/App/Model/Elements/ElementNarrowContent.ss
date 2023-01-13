<div class="element-narrow-content element-narrow-content--{$BackgroundColour}">
	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<% if $CircleColour != 'None' %>
		<div class="element-narrow-content__circle element-narrow-content__circle--{$CircleColour.Lowercase}">
			{$SVGIcon('semi-circle', 1575, 2089)}
		</div>
	<% end_if %>

	<div class="container container--narrow typography trim">
		{$TitleTag}

		{$HTML}
	</div>

	<% if $ShowBall %>
		<div class="element-narrow-content__ball <% if $BallColour != 'None' %> element-two-column--padding-bottom ball--{$BallColour.Lowercase}<% end_if %>">
			{$Ball}
		</div>
	<% end_if %>
</div>
