<div class="element-intro-block element-intro-block--{$Colour.Lowercase}">
	<% include App\Model\Elements\Includes\Breadcrumbs %>

	<div class="container typography trim">
		<div class="element-intro-block__column">
			{$TitleTag}

			{$HTML}
		</div>
	</div>

	<% if $Image %>
		<div class="element-intro-block__right">
			<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 711.9 742"
				 preserveAspectRatio="none">
				<path d="M711.4,0.7C134.1,156.9,0.6,741.5,0.6,741.5h710.7V0.7z" fill="currentColor"/>
			</svg>

			<div class="element-intro-block__image">
				{$Image}
			</div>
		</div>
	<% end_if %>
</div>
