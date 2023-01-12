<div class="card">
	<div class="card__image">
		{$FeaturedImage.ScaleWidth(360, 223)}
	</div>

	<div class="card__content">
		<h3>
			<a href="{$Link}">
				{$Title}
			</a>
		</h3>

		<time datetime="{$PublishDate}">
			{$PublishDate.Format('dd MMMM yyyy')}
		</time>

		<div class="card__summary">
			{$Summary}
		</div>

		<span class="card__arrow">{$SVGIcon('arrow', 20, 20)}</span>
	</div>
</div>
