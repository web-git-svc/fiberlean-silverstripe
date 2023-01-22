<div class="element-card-feature-boxes bg--blue-dark">
	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<% if $TitleTag || $HTML %>
		<div class="container typography typography--white">
			<div class="element-card-feature-boxes__before">
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
		<% if $FeatureBoxes %>
			<ul class="element-card-feature-boxes__grid">
				<% loop $FeatureBoxes %>
					<li class="element-card-feature-boxes__column">
						<div class="element-card-feature-boxes__card typography">
							<% if $Title %>
								<h3 class="typography--white">
									{$Title}
								</h3>
							<% end_if %>

							<div class="element-card-feature-boxes__card-image">
								<% if $Image %>
									{$Image.FocusFill(576, 314)}
								<% end_if %>
							</div>

							<div class="element-card-feature-boxes__card-content typography--white">
								{$Content}
							</div>

							<% if $LinkSet %>
								<a
									href="{$LinkSet}"
									<% if $LinkTarget %>target="{$LinkTarget}"<% end_if %>
									<% if $LinkType == 'File' %>download<% end_if %>
									class="button button--blue-light button--dark-font"
								>
									{$LinkText}

								</a>
							<% end_if %>
						</div>
					</li>
				<% end_loop %>
			</ul>
		<% end_if %>
	</div>
</div>
