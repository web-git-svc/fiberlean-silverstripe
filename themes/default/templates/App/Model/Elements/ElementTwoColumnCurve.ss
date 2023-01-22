<div class="element-two-column-curve element-two-column-curve--{$Colour.LowerCase}">
	{$SVGIcon('semi-circle', 1575, 2089, 'element-two-column-curve__background-shape')}

	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<% if $TitleTag || $LeftContent %>
		<div class="container typography">
			<div>
				{$TitleTag('large')}
			</div>

			<div class="element-two-column-curve__before">
				<div>
					{$LeftContent}
				</div>

				<div>
					{$RightContent}
				</div>
			</div>
		</div>
	<% end_if %>

	<% if $Colour == 'Blue' %>
		{$Ball('orange')}
	<% else %>
		{$Ball('yellow')}
	<% end_if %>
</div>
