<% include App\Model\Elements\Includes\Breadcrumbs %>

<div class="container">
	<div class="element-slideshow">
		{$TitleTag('element-slideshow__title')}

		<% if $Slides %>
			<div class="splide element-slideshow__carousel" data-element-slideshow-carousel>
				<div class="splide__track">
					<ul class="splide__list">
						<% loop $Slides %>
							<li class="splide__slide element-slideshow__slide">
								{$Image.ElementSlideshowSet}
								<% if $File %>
									<div class="element-slideshow__slide--file">
										<a href="{$File.URL}" class="button button--blue-dark" download>Download {$FileTypeNice}</a>
									</div>
								<% end_if %>
							</li>
						<% end_loop %>
					</ul>
				</div>
				<div class="splide__arrows">
					<button class="splide__arrow splide__arrow--prev">
						{$SVGIcon('arrow-circle', 50, 50)}
					</button>
					<button class="splide__arrow splide__arrow--next">
						{$SVGIcon('arrow-circle', 50, 50)}
					</button>
				</div>
			</div>
		<% end_if %>
	</div>
</div>
