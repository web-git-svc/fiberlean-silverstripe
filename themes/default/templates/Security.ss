<!DOCTYPE html>
<html lang="{$ContentLocale}">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link href="//www.google-analytics.com" rel="dns-prefetch"/>

	<title><% if $MetaTitle %>{$MetaTitle.XML}<% else %>{$Title.XML} | {$SiteConfig.Title}<% end_if %></title>
	<% base_tag %>
	{$MetaTags(false)}
	{$SiteConfig.StartOfHead.RAW}
	<% require themedCSS('dist/css/style') %>
	<% include App\Includes\OpenGraph %>
	{$SiteConfig.EndOfHead.RAW}
</head>
<body class="{$ClassName.ShortName.LowerCase}">
{$SiteConfig.StartOfBody.RAW}

<div class="viewport">
	<svg style="position: absolute; width: 0; height: 0;">
		<clipPath id="intro-block-clip-path" clipPathUnits="objectBoundingBox">
			<path d="M0,1 h1 V0 C0.747,0.069,0.066,0.318,0,1"></path>
		</clipPath>
	</svg>

	<% include App\Includes\Header %>

	<% with $CurrentVIPArea %>
		{$Breadcrumbs}

		<div class="container typography">
			<h1>
				{$Title}
			</h1>
		</div>
	<% end_with %>

	<div class="bg--grey login__section">
		<div class="container typography">
			<p>
				Get access to exclusive Fiberlean content, login to our Member Area here.
			</p>

			<div class="login__grid">
				<div class="login__column">
					<h2>
						Members Area login
					</h2>

					<p>
						Login to your account here.
					</p>

					{$Form}
				</div>

				<div class="login__column">
					<% if $Sent('RegisterForm') %>
						This is sent
					<% else %>
						<h2>
							Not registered yet?
						</h2>

						<p>
							Fill in the form below to request access.
						</p>

						{$RegisterForm}
					<% end_if %>
				</div>
			</div>
		</div>

		<% if $CurrentVIPArea.LoginImage %>
			<div class="login__left">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 711.9 742"
					 preserveAspectRatio="none">
					<path d="M711.4,0.7C134.1,156.9,0.6,741.5,0.6,741.5h710.7V0.7z" fill="currentColor"/>
				</svg>

				<div class="login__image">
					{$CurrentVIPArea.LoginImage}
				</div>
			</div>
		<% end_if %>
	</div>

	<div class="login__section">
		<div class="container">
			<% with $CurrentVIPArea %>
				<% if $FeatureBoxesTitle %>
					<h2 class="login__bottom-title">
						{$FeatureBoxesTitle}
					</h2>
				<% end_if %>

				<% if $FeatureBoxes %>
					<ul class="login__feature-boxes">
						<% loop $FeatureBoxes %>
							<li>
								<div class="login__feature-box">
									<% if $Image %>
										<div class="login__feature-box-image">
											{$Image.FocusFill(576, 576)}
										</div>
									<% end_if %>

									<% if $Title %>
										<h3 class="login__feature-box-title">
											{$Title}
										</h3>
									<% end_if %>

									<% if $Content %>
										<p class="login__feature-box-content">
											{$Content}
										</p>
									<% end_if %>
								</div>
							</li>
						<% end_loop %>
					</ul>
				<% end_if %>

				<% if $FeatureBoxesContent %>
					<p class="login__bottom-content">
						{$FeatureBoxesContent}
					</p>
				<% end_if %>
			<% end_with %>
		</div>

		<div class="login__ball">
			{$Ball('blue')}
		</div>
	</div>

	<% include App\Includes\Footer %>
</div>

{$SiteConfig.EndOfBody.RAW}
</body>
</html>
