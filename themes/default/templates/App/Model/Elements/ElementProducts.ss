<div class="bg--grey">
	<div class="element-products">
		<div class="container">
			<div class="typography">
				<h2 class="large center">
					MFC Products
				</h2>
			</div>

			<% if $Images %>
			<ul class="element-products__grid">
				<% loop $Images %>
					<li>
						{$ScaleWidth(576)}
					</li>
				<% end_loop%>
			</ul>
			<% end_if %>
		</div>
	</div>
</div>
