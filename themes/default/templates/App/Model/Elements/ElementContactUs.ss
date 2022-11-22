<div class="element-contact-us">
	<div class="element-contact-us__images">
		<% if $SiteConfig.ContactImage %>
			<div class="element-contact-us__image">
				{$SiteConfig.ContactImage}
			</div>
		<% end_if %>

		{$Ball('blue')}
	</div>

	<div class="bg--green">
		<div class="container">
			<div class="element-contact-us__column typography">
				<h2 class="large">
					{$SiteConfig.ContactTitle}
				</h2>

				{$SiteConfig.ContactContent}
			</div>
		</div>
	</div>
</div>
