<div class="element-curved-image-content element-curved-image-content--{$Style.LowerCase}">
	<% if $Image %>
		<div class="element-curved-image-content__image">
			{$Image}
		</div>
	<% end_if %>

	<div class="<% if $Style == 'Left' %>bg--green<% end_if %>">
		<div class="container typography">
			<div class="element-curved-image-content__column">
				{$TitleTag('element-curved-image-content__title')}

				<div class="element-curved-image-content__content">
					<div>
						{$HTML}
					</div>

					<% if $Link %>
						<a
							href="{$LinkSet}"
							<% if $LinkTarget %>target="{$LinkTarget}"<% end_if %>
							<% if $LinkType == 'File' %>download<% end_if %>
							class="button<% if $Style == 'Right' %> button--orange<% end_if %>"
						>
							{$LinkText}
						</a>
					<% end_if %>
				</div>
			</div>
		</div>
	</div>

	<% if $Style == 'Right' %>
		{$Ball('orange')}
	<% end_if %>
</div>
