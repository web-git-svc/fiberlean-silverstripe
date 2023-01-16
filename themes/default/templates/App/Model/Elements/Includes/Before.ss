<% include App\Model\Elements\Includes\Breadcrumbs %>

<% if $BeforeHTML %>
	<div class="element__before">
		<div class="container typography">
			{$TitleTag}

			{$BeforeHTML}
		</div>
	</div>
<% end_if %>

