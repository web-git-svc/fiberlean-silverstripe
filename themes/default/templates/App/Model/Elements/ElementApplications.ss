<% if $Applications %>
	<div class="element-applications<% if $Colour %> element-applications--{$Colour}<% end_if %>">
		<div class="typography">
			{$TitleTag}
		</div>

		<% loop $Applications %>
			<div class="element-applications__section">
				<div class="element-applications__ball<% if $Even %> element-applications__ball--right<% end_if %>">
					{$Ball}
				</div>

			<div class="container container--narrow">
				<div class="typography">
					<% if $Title %>
						<h2>
							{$Title}
						</h2>
					<% end_if %>

					{$Content}
				</div>

				<% if $ApplicationItems %>
					<ul class="element-applications__items">
						<% loop $ApplicationItems %>
							<li>
								{$Title}
							</li>
						<% end_loop %>
					</ul>
				</div>
				<% end_if %>
			</div>
		<% end_loop %>
	</div>
<% end_if %>
