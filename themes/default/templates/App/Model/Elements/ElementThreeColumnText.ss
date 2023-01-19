<div class="element-three-column-text <% if $Colour %> element-three-column-text--{$Colour} <% end_if %>">
	<div class="container">
		{$TitleTag('element-three-column-text__title')}
		<div class="element-three-column-text__columns">
			<div class="element-three-column-text__column">
				<h3 class="element-three-column-text__column-title">{$LeftColumnTitle}</h3>
					<div class="element-three-column-text__column-content typography">
						{$LeftColumnContent}
					</div>
			</div>
			<div class="element-three-column-text__column">
				<h3 class="element-three-column-text__column-title">{$MiddleColumnTitle}</h3>
				<div class="element-three-column-text__column-content typography">
					{$MiddleColumnContent}
				</div>
			</div>
			<div class="element-three-column-text__column">
				<h3 class="element-three-column-text__column-title">{$RightColumnTitle}</h3>
				<div class="element-three-column-text__column-content typography">
					{$RightColumnContent}
				</div>
			</div>
		</div>
	</div>
</div>
