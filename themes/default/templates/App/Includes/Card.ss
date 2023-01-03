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
			{$PublishDate}
		</time>

		<p>
			{$Summary}
		</p>

		{$SVGIcon('arrow', 20, 20)}
	</div>
</div>
