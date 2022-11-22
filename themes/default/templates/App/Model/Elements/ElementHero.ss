<div class="element-hero">
	<% if $Image %>
		{$Image.HeroSet}
	<% end_if %>

	<% if $Title %>
		<div class="container">
			<div class="element-hero__content">
				{$Title}
			</div>
		</div>
	<% end_if %>

	{$Ball}

	{$SVGIcon('blob', 1347, 859, 'element-hero__blob')}
</div>
