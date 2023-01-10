<% if $Applications %>
	<div class="element-applications<% if $Colour %> element-applications--{$Colour}<% end_if %> element-applications--bg-{$BackgroundColour}">
		<div class="typography">
			{$TitleTag}
		</div>

		<% loop $Applications %>
			<div class="element-applications__section">
				<% if $Up.ShowBall %>
					<% if $Up.Applications.Count == 1 %>
						<div class="element-applications__ball element-applications__ball--single">
							{$Ball}
						</div>
					<% else %>
						<div class="element-applications__ball<% if $Even %> element-applications__ball--right<% end_if %>">
							{$Ball}
						</div>
					<% end_if %>
				<% end_if %>

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
