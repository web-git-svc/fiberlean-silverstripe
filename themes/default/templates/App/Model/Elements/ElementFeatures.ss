<div class="bg--blue-dark typography--white">
	<div class="container container--narrow">
		<div class="typography">
			{$TitleTag('center')}
		</div>

		<% if $Features %>
			<ul class="element-features__row">
				<% loop $Features %>
					<li class="element-features__feature">
						<div class="element-features__feature-icon">
							{$Icon}
						</div>

						<p class="element-features__feature-title">
							{$Title}
						</p>
					</li>
				<% end_loop %>
			</ul>
		<% end_if %>
	</div>
</div>
