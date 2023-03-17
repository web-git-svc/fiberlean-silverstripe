<div class="element-hero">
	<div class="splide element-hero__carousel" data-element-hero-carousel>
		<div class="splide__track">
			<ul class="splide__list">
				<% loop $HeroSlides %>
					<li class="splide__slide element-hero__slide<% if $Top.DoNotCrop %> element-hero__slide--no-crop<% end_if %>">
						<% if $Image %>
							<div class="element-hero__image">
								<% if $Top.DoNotCrop %>
									{$Image.HeroNoCropSet}
								<% else %>
									{$Image.HeroSet}
								<% end_if %>
							</div>
						<% end_if %>

						<% if $Title %>
							<div class="element-hero__content">
								<div class="container">
									{$Title}
								</div>
							</div>
						<% end_if %>

						<% if $BallColour != 'none' %>
							{$Ball($BallColour)}

							{$SVGIcon('blob', 1347, 859, 'element-hero__blob')}
						<% end_if %>
					</li>
				<% end_loop %>
			</ul>
		</div>
	</div>
</div>
