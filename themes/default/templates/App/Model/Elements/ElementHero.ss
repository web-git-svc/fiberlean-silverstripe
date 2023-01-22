<div class="element-hero">
	<div class="splide element-hero__carousel" data-element-hero-carousel>
		<div class="splide__track">
			<ul class="splide__list">
				<% loop $HeroSlides %>
					<li class="splide__slide element-hero__slide">
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

						{$Ball($BallColour)}

						{$SVGIcon('blob', 1347, 859, 'element-hero__blob')}
					</li>
				<% end_loop %>
			</ul>
		</div>
	</div>
</div>
