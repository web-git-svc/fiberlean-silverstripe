<div class="element-content-with-features element-content-with-features--{$Colour.LowerCase} ball--{$Colour.LowerCase}">
	<% if $Image %>
		<div class="element-content-with-features__background-shape">
			{$Image}
		</div>
	<% else %>
		{$SVGIcon('semi-circle', 1575, 2089, 'element-content-with-features__background-shape')}
	<% end_if %>

	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<% if $TitleTag || $HTML %>
		<div class="container typography">
			<div class="element-content-with-features__before">
				<div>
					{$TitleTag('large')}
				</div>

				<% if $HTML %>
					<div>
						{$HTML}
					</div>
				<% end_if %>
			</div>
		</div>
	<% end_if %>

	<div class="container">
		<% if $Features %>
			<ul class="element-content-with-features__grid element-content-with-features__grid--{$Columns.LowerCase}">
				<% loop $Features %>
					<li class="element-content-with-features__column">
						<div class="element-content-with-features__card">
							{$Title}
						</div>
					</li>
				<% end_loop %>
			</ul>
		<% end_if %>
	</div>

	{$Ball}
</div>
