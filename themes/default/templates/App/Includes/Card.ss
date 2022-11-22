<div class="card">
	<div class="card__image">
		{$Image}
	</div>

	<div class="card__content">
		<h3>
			<a href="{$Link}">
				<%--                                    {$Title}--%>
				A much longer two line news article headline
			</a>
		</h3>

		<time datetime="{$PublishDate}">
			{$PublishDate}
			01 January 2022
		</time>

		<p>
			{$Summary}
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
			labore et dolore magna aliqua.
		</p>

		{$SVGIcon('arrow', 20, 20)}
	</div>
</div>
