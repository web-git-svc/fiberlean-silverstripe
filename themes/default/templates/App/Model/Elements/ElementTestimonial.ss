<div class="element-testimonial<% if $Colour %> element-testimonial--{$Colour} ball--{$Colour}<% end_if %>">
	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<div class="container container--narrow">
		<% if $Testimonial %>
			<div class="element-testimonial__open-quote">
				“
			</div>

			<blockquote class="element-testimonial__quote">
				<p>
					{$Testimonial}
				</p>

				<% if $TestimonialAuthor %>
					<footer>
						{$TestimonialAuthor}
					</footer>
				<% end_if %>
			</blockquote>
		<% end_if %>

		<% if $LinkSet %>
			<a href="{$LinkSet}" class="button"<% if $LinkTarget %> target="{$LinkTarget}"<% end_if %>>
				{$LinkText}
			</a>
		<% end_if %>
	</div>

	<% if $Colour %>
		<div class="element-testimonial__ball element-testimonial__ball--left">
			{$Ball}
		</div>

		<div class="element-testimonial__ball element-testimonial__ball--right">
			{$Ball}
		</div>
	<% end_if %>
</div>
