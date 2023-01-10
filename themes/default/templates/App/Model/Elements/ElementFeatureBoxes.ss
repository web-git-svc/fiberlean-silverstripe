<div class="element-feature-boxes element-feature-boxes--{$Colour.LowerCase}">
	{$SVGIcon('semi-circle', 1575, 2089, 'element-feature-boxes__background-shape')}

	<% if $TitleTag || $HTML %>
		<div class="container typography">
			<div class="element-feature-boxes__before">
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
			<ul class="element-feature-boxes__grid element-feature-boxes__grid--{$Columns.LowerCase}">
				<% loop $FeatureBoxes %>
					<li class="element-feature-boxes__column">
						<div class="element-feature-boxes__card typography">
							<div class="element-feature-boxes__card-image">
								<% if $Image %>
									{$Image.FocusFill(576, 576)}
								<% end_if %>
							</div>

							<div class="element-feature-boxes__card-content">
								<h3>
									<% if $Link %>
										<a
											href="{$LinkSet}"
											<% if $LinkTarget %>target="{$LinkTarget}"<% end_if %>
											<% if $LinkType == 'File' %>download<% end_if %>
										>
									<% end_if %>

									{$Title}

									<% if $Link %>
											{$SVGIcon('arrow', 20, 20)}
										</a>
									<% end_if %>
								</h3>
							</div>
						</div>
					</li>
				<% end_loop %>
			</ul>
		<% end_if %>
	</div>

	<% if $Colour == 'Blue' %>
		{$Ball('orange')}
	<% else %>
		{$Ball('yellow')}
	<% end_if %>
</div>
